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
            $Shapefile = new ShapefileReader(WRITEPATH . '/shp/pati/ADMIN_NUL.shp');
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
					// print_r($array);
					// print_r($jsonData);
					$namaKel = $array['WADMKD'];
					// if ($namaKel == 'Ketitangwetan') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 70);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Raci') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 512);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Tlogomojo') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 7);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Koripandriyo') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 356);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Kosekan') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 513);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Semirejo') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 514);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Sumberarum') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 361);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Karangrejo Lor') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 354);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Jambean Kidul') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 12);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Mataraman') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 318);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Sokobubuk') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 515);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Sokokulon') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 75);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Margotohu Kidul') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 374);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Soneyan') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 37);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Pati Kidul') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 136);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Pati Lor') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 241);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Pati Wetan') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 94);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Kletek') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 152);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Lumbungmas') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 89);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Tanjungsekar') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 256);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Kasiyan') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 289);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Porangparing') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 148);
					// 	$table->update($dataUpdate);
					// }

					// if ($namaKel == 'Danyangmulyo') {
					// 	$dataUpdate = [
					// 		'shp' => $shp
					// 	];
					// 	$table->where('id', 235);
					// 	$table->update($dataUpdate);
					// }
					
					$query = $table->where(['nama_kel' => $namaKel, 'shp' => null])->get()->getRowArray();
					if (empty($query)) {
						print_r($array);
					} else {
						$dataUpdate = [
							'shp' => $shp
						];
						$table->where('id', $query['id']);
						$table->update($dataUpdate);
					}
					// $kodeKel = explode('.', $array['KDEPUM']);
					// $query = $table->where(['no_prop' => $kodeKel[0], 'no_kab' => $kodeKel[1], 'no_kec' => $kodeKel[2], 'no_kel' => $kodeKel[3]])->get()->getRowArray();
					// if (empty($query)) {
					// 	// echo "desa tidak di ketahui\n";
					// 	// print_r($array);
					// 	// print_r($jsonData);
					// } else {
					// 	$dataInsert = [
					// 		'kec' => $kodeKel[2],
					// 		'kel' => $kodeKel[3],
					// 		'shp' => $shp,
					// 		'uupp' => $array['UUPP'],
					// 		'banjir' => $array['BANJIR']
					// 	];
					// 	$db->table('peta_banjir')->insert($dataInsert);
					// }

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

	public function custom()
    {
		$db = \Config\Database::connect();
		$table = $db->table('kel');
        try {
            $Shapefile = new ShapefileReader(WRITEPATH . '/shp/pati/ADMIN_NULL.shp');
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

					print_r($array);
					// 
					// $dataInsert = [
					// 	'qname23' => $array['QNAME23'],
					// 	'jswh' => $array['JSWH'],
					// 	'ctkswh' => $array['CTKSWH'],
					// 	'namobj' => $array['NAMOBJ'],
					// 	'ket' => $array['KET'],
					// 	'ket_1' => $array['KET_1'],
					// 	'qname2024' => $array['QNAME2024'],
					// 	'fid_admini' => $array['FID_ADMINI'],
					// 	'desa' => $array['WADMKD'],
					// 	'kecamatan' => $array['WADMKC'],
					// 	'shp' => $shp
					// ];

					// $table2 = $db->table('lbs')->insert($dataInsert);
					
					// $kodeKel = explode('.', $array['KDEPUM']);
					// $query = $table->where(['no_prop' => $kodeKel[0], 'no_kab' => $kodeKel[1], 'no_kec' => $kodeKel[2], 'no_kel' => $kodeKel[3]])->get()->getRowArray();
					// if (empty($query)) {
					// 	// echo "desa tidak di ketahui\n";
					// 	// print_r($array);
					// 	// print_r($jsonData);
					// } else {
					// 	$dataInsert = [
					// 		'kec' => $kodeKel[2],
					// 		'kel' => $kodeKel[3],
					// 		'shp' => $shp,
					// 		'uupp' => $array['UUPP'],
					// 		'banjir' => $array['BANJIR']
					// 	];
					// 	$db->table('peta_banjir')->insert($dataInsert);
					// }

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
