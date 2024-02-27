<?php

declare(strict_types=1);

namespace App\Services\Company\Http\Controller;

use App\Http\Requests\Company\AddCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Services\Company\Database\Repository\CompanyRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CompanyController extends BaseController
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function addCompany(AddCompanyRequest $addCompanyRequest): JsonResponse
    {
        $nameCompany = $addCompanyRequest['name'];
        $filePath = Storage::disk('public')->put("/logos/$nameCompany", $addCompanyRequest['logo']);

        $addCompany = $this->companyRepository->addCompany($addCompanyRequest, (string) $filePath);

        if ($addCompany === false) {
            Storage::deleteDirectory("public/logos/$nameCompany");

            throw new Exception('Ошибка создания компании');
        }

        return ResponseBuilder::success(['Компания создана']);
    }

    public function updateCompany(UpdateCompanyRequest $updateCompanyRequest, int $id): JsonResponse
    {
        $nameCompany = $updateCompanyRequest['name'];
        $filePath = Storage::disk('public')->put("/logos/$nameCompany", $updateCompanyRequest['logo']);

        $updateCompany = $this->companyRepository->updateCompany($updateCompanyRequest, $id, (string) $filePath);

        if ($updateCompany === false) {
            Storage::deleteDirectory("public/logos/$nameCompany");

            throw new Exception('Ошибка обновления компании, неверный id');
        }

        return ResponseBuilder::success(['Компания обновлена']);
    }

    public function deleteCompany($id): JsonResponse
    {
        $company = $this->companyRepository->find($id);

        if ($company === null) {
            throw new Exception('По указанному id нет компании');
        }

        $nameCompany = $company['name'];

        $result = $company->delete();

        if ($result === true) {
            Storage::deleteDirectory("public/logos/$nameCompany");
        } else {
            throw new Exception('Произошла ошибка удаления компании');
        }

        return ResponseBuilder::success(['Компания удалена']);
    }
}
