<?php
date_default_timezone_set('Asia/Jakarta');

function tgl_indonesia($date)
{
	/* array hari dan bulan */
	$nama_hari  = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");

	$nama_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
	                    "November","Desember");

	/*  Memisahkan format tanggal, bulan, tahun dengan substring */
	$tahun   = substr($date, 0, 4);
	$bulan   = substr($date, 5, 2);
	$tanggal = substr($date, 8, 2);
	$waktu   = substr($date, 11, 5);

	//w Urutan hari dalam seminggu
	$hari    = date("w", strtotime($date));

	$result  = $nama_hari[$hari] . ", " .$tanggal. " " .$nama_bulan[(int)$bulan-1]. " " .$tahun. " " .$waktu. " WIB";
	//keterangan (int)$bulan-1 karena array dimulai dari index ke 0 maka bulan-1
	return $result;
}

function anti_injection($data)
{
	$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter;
}

function slug($s)
{
	$c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}


function rupiah($nominal)
{
	return 'Rp '.number_format($nominal, 0, ',', '.');
}

/** login codeIgniter menggunakan bycrypt **/

if(!function_exists('get_hash'))
{    
    function get_hash($PlainPassword)
    {
    	$option=[
                'cost'=>5,// proses hash sebanyak: 2^5 = 32x
    	        ];
    	return password_hash($PlainPassword, PASSWORD_DEFAULT, $option);
   }
}

if(!function_exists('hash_verified'))
{  
    function hash_verified($PlainPassword,$HashPassword)
    {
    	return password_verify($PlainPassword,$HashPassword) ? true : false;
   }
}

	function tanggalindo($tanggal)
	{
		$bulan = array (
			1 => 'Januari',
				 'Februari',
				 'Maret',
				 'April',
				 'Mei',
				 'Juni',
				 'Juli',
				 'Agustus',
				 'September',
				 'Oktober',
				 'November',
				 'Desember'
		);
		$p = explode('-', $tanggal);
		return $p[2] . ' ' . $bulan[ (int)$p[1] ] . ' ' . $p[0];
	}

/** login codeIgniter menggunakan bycrypt **/

function encrypt_url($string) {
     $output = false;
     /*
     * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
     */       
     $security       = parse_ini_file("security.ini");
     $secret_key     = $security["encryption_key"];
     $secret_iv      = $security["1227892283737428"];
     $encrypt_method = $security["encryption_mechanism"];
     // hash
     $key    = hash("sha256", $secret_key);
     // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
     $iv     = substr(hash("sha256", $secret_iv), 0, 16);
     //do the encryption given text/string/number
     $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
     $output = base64_encode($result);
     return $output;
}
function decrypt_url($string) {
     $output = false;
     /*
     * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
     */
     $security       = parse_ini_file("security.ini");
     $secret_key     = $security["encryption_key"];
     $secret_iv      = $security["1227892283737428"];
     $encrypt_method = $security["encryption_mechanism"];
     // hash
     $key    = hash("sha256", $secret_key);
     // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
     $iv = substr(hash("sha256", $secret_iv), 0, 16);
     //do the decryption given text/string/number
     $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
     return $output;
}