<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 05/08/17
 * Time: 13:53
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ImageResize;
use AppBundle\Entity\Pembayaran;
use AppBundle\Entity\Barang;
use AppBundle\Entity\Pemesanan;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
                $data->setEmail($request->get('email'));
                $data->setAddress($request->get('address'));
                $data->setNoTelp($request->get('no_telp'));
            }

            if (!(is_dir($this->getParameter('profile_directory')['resource']))) {
                @mkdir($this->getParameter('profile_directory')['resource'], 0777, true);
            }

            if(!empty($request->files->get('profile_photo'))) {
                $file = $request->files->get('profile_photo');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $exAllowed = array('jpg', 'png', 'jpeg');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($ext, $exAllowed)) {
                    if ($file instanceof UploadedFile) {
                        if (!($file->getClientSize() > (1024 * 1024 * 1))) {
                            ImageResize::createFromFile(
                                $request->files->get('profile_photo')->getPathName()
                            )->saveTo($this->getParameter('profile_directory')['resource'] . '/' . $filename, 20, true);
                            $data->setProfilePhoto($filename);
                        } else {
                            return 'gambar tidak boleh lebih dari 1 MB';
                        }
                    }
                } else {
                    return 'cek kembali extension gambar anda';
                }
            }

            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_list_user'));
        }

        return $this->render('AppBundle:backend:update-user.html.twig',['data'=>$data]);
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(User::class)->find($id);

        $em->remove($data);
        $em->flush();

        return $this->redirect($this->generateUrl('app_admin_list_user'));
    }

    public function updatePemesananAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pemesanan::class)->find($id);

        if($request->getMethod() == 'POST') {
            if($data instanceof Pemesanan) {
                $data->setNamaPemesan($request->get('nama_pemesanan'));
            }
        }
    }
    
    public function createBarangAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if($request->getMethod() == 'POST') {
            $barang = new Barang();
            $barang->setNamaBarang($request->get('nama_barang'));
            $barang->setHargaBarang($request->get('harga_barang'));
            $barang->setDescription($request->get('description'));
            $barang->setJenisBarang($request->get('jenis_barang'));
            $barang->setIsTop($request->get('top'));
            $barang->setIsNew($request->get('new'));

            if (!(is_dir($this->getParameter('barang_directory')['resource']))) {
                @mkdir($this->getParameter('barang_directory')['resource'], 0777, true);
            }

            if(!empty($request->files->get('profile_barang'))) {
                $file = $request->files->get('profile_barang');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $exAllowed = array('jpg', 'png', 'jpeg');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($ext, $exAllowed)) {
                    if ($file instanceof UploadedFile) {
                        if (!($file->getClientSize() > (1024 * 1024 * 1))) {
                            ImageResize::createFromFile(
                                $request->files->get('profile_barang')->getPathName()
                            )->saveTo($this->getParameter('barang_directory')['resource'] . '/' . $filename, 20, true);
                            $barang->setProfileBarang($filename);
                        } else {
                            return 'gambar tidak boleh lebih dari 1 MB';
                        }
                    }
                } else {
                    return 'cek kembali extension gambar anda';
                }
            }

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

        $em->remove($data);
        $em->flush();

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
                $data->setDescription($request->get('description'));
                $data->setJenisBarang($request->get('jenis_barang'));
                $data->setIsTop($request->get('top'));
                $data->setIsNew($request->get('new'));
            }

            if (!(is_dir($this->getParameter('barang_directory')['resource']))) {
                @mkdir($this->getParameter('barang_directory')['resource'], 0777, true);
            }

            if(!empty($request->files->get('profile_barang'))) {
                $file = $request->files->get('profile_barang');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $exAllowed = array('jpg', 'png', 'jpeg');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($ext, $exAllowed)) {
                    if ($file instanceof UploadedFile) {
                        if (!($file->getClientSize() > (1024 * 1024 * 1))) {
                            ImageResize::createFromFile(
                                $request->files->get('profile_barang')->getPathName()
                            )->saveTo($this->getParameter('barang_directory')['resource'] . '/' . $filename, 20, true);
                            $data->setProfileBarang($filename);
                        } else {
                            return 'gambar tidak boleh lebih dari 1 MB';
                        }
                    }
                } else {
                    return 'cek kembali extension gambar anda';
                }
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

    public function editProsesAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pemesanan::class)->find($id);

        if($request->getMethod() == 'POST') {
            $data->setIsProses($request->get('proses'));

            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_list_pemesanan'));
        }

        return $this->render('AppBundle:backend:edit-proses.html.twig',['data'=>$data]);
    }

    public function getAllPembayaranAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pembayaran::class)->findAll();

        return $this->render('AppBundle:backend:list-pembayaran.html.twig',['data'=>$data]);
    }

    public function editConfirmAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pembayaran::class)->find($id);

        if($request->getMethod() == 'POST') {
            if($data instanceof Pembayaran) {
                $data->setIsConfirm($request->get('confirm'));
            }

            $em->persist($data);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_list_pembayaran'));
        }

        return $this->render('AppBundle:backend:edit-confirm.html.twig',['data'=>$data]);
    }

    public function deletePembayaranAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $em->getRepository(Pembayaran::class)->find($id);

        $em->remove($data);

        $em->flush();

        return $this->redirect($this->generateUrl('app_admin_list_pembayaran'));
    }
}