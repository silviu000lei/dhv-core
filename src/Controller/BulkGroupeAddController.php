<?php

namespace App\Controller;

use App\Entity\CourantMusical;
use App\Entity\Groupe;
use App\Repository\CourantMusicalRepository;
use App\Repository\GroupeRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Route("/api", name="api_")
 */
class BulkGroupeAddController extends AbstractController
{
    #[Route('/bulk/groupe/add', name: 'bulk_groupe_add')]
    /**
     * @param Request $request
     * @throws \Exception
     **/
    public function bulkInsert(Request $request, CourantMusicalRepository $courantMusicalRepository, GroupeRepository $groupeRepository): JsonResponse
    {
        $file = $request->files->get('xlsxFile'); // get the file from the sent request

        $fileFolder = __DIR__ . '/../../public/uploads/';  //choose the folder in which the uploaded file will be stored

        $filePathName = md5(uniqid()) . $file->getClientOriginalName();
        // apply md5 function to generate an unique identifier for the file and concat it with the file extension
        try {
            $file->move($fileFolder, $filePathName);
        } catch (FileException $e) {
            return $this->json(['message' => $e->getMessage(), 'code' => $e->getCode()], JsonResponse::HTTP_NOT_FOUND);
        }
        $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file
        $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
        $collection = new ArrayCollection([]);

        foreach ($sheetData as $groupeData){
            $groupe = new Groupe();
            $groupe->setNomDuGroupe($groupeData['A'])
                ->setOrigine($groupeData['B'])
                ->setVille($groupeData['C'])
                ->setAnneeDebut($groupeData['D'])
                ->setAnneeSeparation($groupeData['E'])
                ->setFondateurs($groupeData['F'])
                ->setMembers($groupeData['G']);
            if($groupeData['H']){
                $courantMusical = $courantMusicalRepository->findOneBy(["genre" => $groupeData['H']]);
                if(!$courantMusical){
                    $courantMusical = new CourantMusical();
                    $courantMusical->setGenre($groupeData['H']);

                    $courantMusicalRepository->save($courantMusical);
                }
                $groupe->setCourantMusical($courantMusical);
            }
            $groupe->setPresentation($groupeData['I']);
            $collection->add($groupe);
        }

        $groupeRepository->bulkSave($collection);

        return $this->json(['message' => 'Success insert xlsx in to db']);
    }
}
