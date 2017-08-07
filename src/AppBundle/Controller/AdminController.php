<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 05/08/17
 * Time: 13:53
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Barang;
use AppBundle\Entity\Pemesanan;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('AppBundle:backend:admin.html.twig');
    }

    public function getAllUserAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(User::class)->findAll();

        return $this->render('AppBundle:backend:list-user.html.twig',[
            'data'=>$data
        ]);
    }

    public function updateUserAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(User::class)->find($id);

        if($request->getMethod() == 'POST') {
            if($data instanceof User) {
                $data->setFirstname($request->get('firstname'));
                $data->setLastname($request->get('lastname'));
                $data->setUsername($request->get('username'));
                $data->setEmail($request->get('email'));
                $data->setPassword($request->get('password'));
                $data->setNoTelp($request->get('no_telp'));
            }

            $em->persist($data);
            $em->flush();
        }
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(User::class)->find($id);

        $em->remove($data);
        $em->flush();

        return 'data berhasil dihapus';
    }
    
    public function createBarangAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if($request->getMethod() == 'POST') {
            $barang = new Barang();
            $barang->setNamaBarang($request->get('nama_barang'));
            $barang->setHargaBarang($request->get('harga_barang'));
            $barang->setJenisBarang($request->get('jenis_barang'));

            $em->persist($barang);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_list_barang'));
        }
        return $this->render('AppBundle:backend:input-barang.html.twig');
    }


    public function getAllBarangAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Barang::class)->findAll();

        return $this->render('AppBundle:backend:list-barang.html.twig',['data'=>$data]);
    }

    public function deleteBarangAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Barang::class)->find($id);

        $data->remove($data);
        $data->flush();

        return $this->redirect($this->generateUrl('app_admin_list_barang'));
    }

    public function updateBarangAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Barang::class)->find($id);

        if($request->getMethod() == 'POST') {
            if ($data instanceof Barang) {
                $data->setNamaBarang($request->get('nama_barang'));
                $data->setHargaBarang($request->get('harga_barang'));
                $data->setJenisBarang($request->get('jenis_barang'));
            }
            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_list_barang'));
        }

        return $this->render('AppBundle:backend:update-barang.html.twig',['data'=>$data]);
    }

    public function getAllPemesananAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pemesanan::class)->findAll();

        return $this->render('AppBundle:backend:list-pemesanan.html.twig',['data'=>$data]);
    }

    public function deletePemesananAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pemesanan::class)->find($id);

        $em->remove($data);

        $em->flush();

        return $this->redirect($this->generateUrl('app_admin_list_pemesanan'));
    }




    

}