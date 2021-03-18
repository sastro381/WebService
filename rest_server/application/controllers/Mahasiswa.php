<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        // Users from a data store e.g. database
        $id = $this->get( 'nim' ); // ini fungsinya buat ngambil nilai yg mok kirim  
        if ( $id == null ) // ini buat ngecek udah ke isi apa belum 
        {
            //kalo misal belu masuk ke sini
            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->join('jurusan', 'mahasiswa.id_jurusan = jurusan.id_jurusan');
            $users = $this->db->get()->result(); // ini fungsinya buat select semua data di table mahasiswa
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
            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->join('jurusan', 'mahasiswa.id_jurusan = jurusan.id_jurusan');
            $this->db->where('nim', $id);
            $users = $this->db->get()->result(); // ini sama baris diatasnya fungsinya buat ngambil data ditable mahasiswa berdasarkan
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

    public function index_post(){

        $data = array(
                'nim' => $this->post( 'nim' ), // ini buat nangkep inputan type POST yg mok kirim
                'nama' => $this->post( 'nama' ),
                'id_jurusan' => $this->post( 'id_jurusan' ),
                'alamat' => $this->post( 'alamat' )
        ); //semuanya inputamu bapak ditampung dalam array
        
        $this->db->insert('mahasiswa', $data); // ini fungsinya buat insert data ke database
        $result = $this->db->affected_rows(); // ini buat ngecek apakah berhasil apa enggak, klo berhasil isinya 1 klo gagal 0
        if($result > 0){ // ini buat ngecek isinya tadi
            $this->response([
                'status' => true,
                'message' => 'Data berhasil disimpan'],200); // ini ngasih respon ke client sama kyak yg diatas tadi
        }else{
            $this->response([
                'status' => true,
                'message' => 'Data gagal disimpan'],503); // ini ngasih respon ke client sama kyak yg diatas tadi
        }
        
    }

    public function index_put(){
        $data = array(
                //'nim' => $this->post( 'nim' ),
                'nama' => $this->put( 'nama' ),
                'id_jurusan' => $this->put( 'id_jurusan' ),
                'alamat' => $this->put( 'alamat' )
        );
        // print_r($this->put());
        // exit;
        $this->db->where('nim', $this->put( 'nim' ));
        $this->db->update('mahasiswa', $data); // ini sama satu baris diatasnya fungsinya buat update data berdasarkan nimnya
        $result = $this->db->affected_rows();// ini buat ngecek apakah berhasil apa enggak, klo berhasil isinya 1 klo gagal 0
        if($result > 0){ // ini buat ngecek isinya tadi
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diupdate'],200);  // ini ngasih respon ke client sama kyak yg diatas tadi  
        }else{
            $this->response([
                'status' => true,
                'message' => 'Data gagal diupdate'],503); // ini ngasih respon ke client sama kyak yg diatas tadi
        }
        
    }

    public function index_delete(){
        if($this->delete( 'nim' ) == null)  // ini buat ngecek udah ke isi apa belum 
        {
            $this->response([
                'status' => false,
                'message' => 'Data Tidak ditemukan'],404); // ini ngasih respon ke client sama kyak yg diatas tadi  
        }
        $this->db->where('nim', $this->delete( 'nim' )); 
        $this->db->delete('mahasiswa'); // ini sama satu baris diatasnya fungsinya buat ngehapus data berdasarkan nim, klo diterjemahin ke query
        //jadinya gini delete from mahasiswa where nim = 'isi dari nimmu'

        $result = $this->db->affected_rows(); // ini buat ngecek apakah berhasil apa enggak, klo berhasil isinya 1 klo gagal 0
        if($result > 0){ // ini buat ngecek isinya tadi
            $this->response([
                'status' => true,
                'message' => 'Data berhasil dihapus'],200); // ini ngasih respon ke client sama kyak yg diatas tadi  
        }else{
            $this->response([
                'status' => true,
                'message' => 'Data gagal dihapus'],503); // ini ngasih respon ke client sama kyak yg diatas tadi  
        }
        
    }
}