<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
class Jurusan extends RestController {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $id = $this->get( 'id' ); // ini fungsinya buat ngambil nilai yg mok kirim  
        if ( $id == null ) // ini buat ngecek udah ke isi apa belum 
        {
            //kalo misal belu masuk ke sini
            $users = $this->db->get('jurusan')->result(); // ini fungsinya buat select semua data di table mahasiswa
            if ( $users) // ini buat ngecek apakah variable $user itu udah ada isinya apa belom
            {
                //kalo ada isinya masuk sini
                $this->response( $users, 200 ); // ini fungsinya buat nampilin semua isi dari variable user
            }
            else
            {
                //kalo engga ada isinya masuk sini
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 ); // ini fungsinya buat munculin pesan klo gak ada user didalem db itu
            }
        }
        else
        {
            //kalo misal nim ada isinya ke sini
            $this->db->where('id_jurusan', $id);
            $users = $this->db->get('jurusan')->result(); // ini sama baris diatasnya fungsinya buat ngambil data ditable mahasiswa berdasarkan
            //nim yg udah diisi tadi, kalo diterjemahin diquery jadi gini "select * from mahasiswa where nim = 'ini isi idmu'"

            if ( $users )// ini buat ngecek apakah variable $user itu udah ada isinya apa belom
            {
                //kalo ada isinya masuk sini
                $this->response( $users, 200 );  // ini fungsinya buat nampilin semua isi dari variable user
            }
            else
            {
                //kalo engga ada isinya masuk sini
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 ); // ini fungsinya buat munculin pesan klo gak ada user didalem db itu
            }
        }
    }

}
?>