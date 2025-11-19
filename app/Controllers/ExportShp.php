<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;
use CodeIgniter\HTTP\ResponseInterface;
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class ExportShp extends BaseController
{
    public function index()
    {
		$db = \Config\Database::connect();
		$table = $db->table('kel');
        try {
            $Shapefile = new ShapefileReader(WRITEPATH . '/shp/ADMIN_GROBOGAN_GEOGRAFIS.shp');
            $tot = $Shapefile->getTotRecords();
			for ($i = 1; $i <= $tot; ++$i) {
				try {
					// Manually set current record. Don't forget this!
					$Shapefile->setCurrentRecord($i);
					// Fetch a Geometry
					$Geometry = $Shapefile->fetchRecord();
					// Skip deleted records
					if ($Geometry->isDeleted()) {
						continue;
					}
					$array = $Geometry->getDataArray();
					$jsonData = $Geometry->getWKT();
					$shp = new RawSql("ST_GeomFromText('".$jsonData."')");

					$kodeKel = explode('.', $array['KDEPUM']);
					$query = $table->where(['no_prop' => $kodeKel[0], 'no_kab' => $kodeKel[1], 'no_kec' => $kodeKel[2], 'no_kel' => $kodeKel[3]])->get()->getRowArray();
					if (empty($query)) {
						echo "desa tidak di ketahui\n";
						print_r($array);
						print_r($jsonData);
					} else {
						$dataUpdate = [
							'shp' => $shp
						];
						$table->update($dataUpdate, ['id' => $query['id']]);
					}

				} catch (ShapefileException $e) {
					// Handle some specific errors types or fallback to default
					switch ($e->getErrorType()) {
					    // We're crazy and we don't care about those invalid geometries... Let's skip them!
					    case Shapefile::ERR_GEOM_RING_AREA_TOO_SMALL:
					    case Shapefile::ERR_GEOM_RING_NOT_ENOUGH_VERTICES:
					        // The following "continue" statement is just syntactic sugar in this case
					        // continue;
					        break;
							
					    // Let's handle this case differently... :)
					    case Shapefile::ERR_GEOM_POLYGON_WRONG_ORIENTATION:
					        exit("Do you want the Earth to change its rotation direction?!?");
					        break;
							
					    // A fallback is always a nice idea
					    default:
					        exit(
					            "Error Type: "  . $e->getErrorType()
					            . "\nMessage: " . $e->getMessage()
					            . "\nDetails: " . $e->getDetails()
					        );
					        break;
					}
				}
			}
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
