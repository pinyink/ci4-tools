<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class ExportShp extends BaseController
{
    public function index()
    {
        echo "hello";
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
					$data = [];
					$array = $Geometry->getDataArray();
					
					$jsonData = $Geometry->getWKT();
                    print_r($array);
                    print_r($jsonData);

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
