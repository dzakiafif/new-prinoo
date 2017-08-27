<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 05/08/17
 * Time: 10:55
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\ImageResize;
use AppBundle\Entity\Barang;
use AppBundle\Entity\Pembayaran;
use AppBundle\Entity\Pemesanan;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $barang = $em->getRepository(Barang::class)->findAll();


        if($request->getMethod() == 'POST') {

            if($this->isGranted('ROLE_USER')) {
                $pemesanan = new Pemesanan();
                $pemesanan->setUser($user);
                $pemesanan->setBarang($em->getRepository(Barang::class)->find($request->get('barang')));
                $pemesanan->setTotalPemesan($request->get('total_pemesan'));
                $pemesanan->setTotalHarga($request->get('total_harga'));
                $pemesanan->setIsProses(0);
                $em->persist($pemesanan);
                $em->flush();

                return $this->redirect($this->generateUrl('app_success'));
            }else {
                return $this->redirect($this->generateUrl('app_error'));
            }

        }

        return $this->render('AppBundle:frontend:home.html.twig',['barang'=>$barang]);
    }

    public function notificationAction()
    {
        return $this->render('AppBundle:frontend:notification.html.twig');
    }

    public function successAction()
    {
        return $this->render('AppBundle:frontend:success.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('AppBundle:backend:admin.html.twig');
    }

    public function faqAction()
    {
        return $this->render('AppBundle:frontend:faq.html.twig');
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


    public function createPembayaranAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $barang = $em->getRepository(Barang::class)->findAll();
        
        if($request->getMethod() == 'POST') {
            $data = new Pembayaran();
            $data->setUser($user);
            $data->setBarang($em->getRepository(Barang::class)->find($request->get('barang')));

            if (!is_dir($this->getParameter('pembayaran_directory')['resource'])) {
                @mkdir($this->getParameter('pembayaran_directory')['resource'], 0777, true);
            }

             $file = $request->files->get('berkas');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $exAllowed = array('jpg', 'png', 'jpeg');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($ext, $exAllowed)) {
                    if ($file instanceof UploadedFile) {
                        if (!($file->getClientSize() > (1024 * 1024 * 1))) {
                            ImageResize::createFromFile(
                                $request->files->get('berkas')->getPathName()
                            )->saveTo($this->getParameter('pembayaran_directory')['resource'] . '/' . $filename, 20, true);
                            $data->setPembayaranBerkas($filename);
                        } else {
                            return 'gambar tidak boleh lebih dari 1 MB';
                        }
                    }
                } else {
                    return 'cek kembali extension gambar anda';
                }

                $data->setIsConfirm(0);

                $em->persist($data);
                $em->flush();

                return $this->redirect($this->generateUrl('app_user_pembayaran'));
        }
        return $this->render('AppBundle:backend:create-pembayaran.html.twig',[
            'barang' => $barang
        ]);

    }

    public function listPembayaranAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(Pembayaran::class)->findByUser($user->getId());

        return $this->render('AppBundle:backend:user-pembayaran.html.twig',['data'=>$data]);


    }

    public function listPemesananAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(Pemesanan::class)->findBy(['user'=>$user->getId()]);

        return $this->render('AppBundle:backend:user-pemesanan.html.twig',['data'=>$data]);
    }

    public function deletePemesananAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(Pemesanan::class)->find($user->getId());

        $em->remove($data);

        $em->flush();

        return $this->redirect($this->generateUrl('app_user_pemesanan'));
    }

    public function updatePemesananAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(Pemesanan::class)->findOneBy(['user'=>$user->getId()]);

        $barang = $em->getRepository(Barang::class)->findAll();

        if($request->getMethod() == 'POST') {
            if($data instanceof Pemesanan) {
                $data->setUser($user);
                $data->setBarang($em->getRepository(Barang::class)->find($request->get('barang')));
                $data->setTotalPemesan($request->get('total_pemesan'));
                $data->setTotalHarga($request->get('total_harga'));
                $data->setIsProses(0);
            }
            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('app_user_pemesanan'));


        }
        return $this->render('AppBundle:backend:user-update-pemesanan.html.twig',[
            'data'=>$data,
            'barang' => $barang
        ]);

    }

    public function deletePembayaranAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $data = $em->getRepository(Pembayaran::class)->findOneBy(['user'=>$user->getId()]);

        $em->remove($data);

        $em->flush();

        return $this->redirect($this->generateUrl('app_user_pembayaran'));
    }

}