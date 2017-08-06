<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 05/08/17
 * Time: 10:55
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Barang;
use AppBundle\Entity\Pemesanan;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $barang = $em->getRepository(Barang::class)->findAll();

        if($request->getMethod() == 'POST') {
            $pemesanan = new Pemesanan();
            $pemesanan->setBarang($em->getRepository(Barang::class)->find($request->get('barang')));
            $pemesanan->setNamaPemesan($request->get('nama'));
            $pemesanan->setEmailPemesan($request->get('email'));
            $pemesanan->setAlamatPemesan($request->get('alamat'));
            $pemesanan->setNoHp($request->get('no_hp'));
            $pemesanan->setTotalPemesan($request->get('total_pemesan'));
            $pemesanan->setTotalHarga($request->get('total_harga'));

            $em->persist($pemesanan);
            $em->flush();

            return 'data pesanan berhasil masuk';
        }

        return $this->render('AppBundle:frontend:home.html.twig',['barang'=>$barang]);
    }

    public function productAction()
    {
        return $this->render('AppBundle:frontend:product.html.twig');
    }
    

    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if($request->getMethod() == 'POST') {
            $user = new User();
            $user->setFirstname($request->get('firstname'));
            $user->setLastname($request->get('lastname'));
            $user->setUsername($request->get('username'));
            $user->setEmail($request->get('email'));
            $user->setPassword($request->get('password'));
            $user->setNoTelp($request->get('no_telp'));
            $user->setAddress($request->get('address'));
            $user->setRoles(serialize(['ROLE_USER']));

            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('AppBundle:backend:register.html.twig');

    }

    public function updateUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(User::class)->find($user->getId());

        if($request->getMethod() == 'POST') {
            if($data instanceof User) {
                $data->setFirstname($request->get('firstname'));
                $data->setLastname($request->get('lastname'));
                $data->setUsername($request->get('username'));
                $data->setPassword($request->get('password'));
                $data->setEmail($request->get('email'));
                $data->setNoTelp($request->get('no_telp'));
                $data->setAddress($request->get('address'));
            }

            $em->persist($data);
            $em->flush();

            return 'data pribadi berhasil di updated';
        }
    }


    

}