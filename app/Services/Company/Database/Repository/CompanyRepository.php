<?php

declare(strict_types=1);

namespace App\Services\Company\Database\Repository;

use App\Http\Requests\Company\AddCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Services\Company\Database\Models\Company;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends Repository
{
    protected $entity = Company::class;

    public function addCompany(AddCompanyRequest $addCompanyRequest, string $filePath): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'name' => $addCompanyRequest['name'],
                'content' => $addCompanyRequest['content'],
                'logo' => $filePath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function updateCompany(UpdateCompanyRequest $updateCompanyRequest, int $id, string $filePath): bool
    {
        $user = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->first();

        if ($user === null) {
            return false;
        }

        $result = $user->fill([
            'name' => $updateCompanyRequest['name'],
            'surname' => $updateCompanyRequest['surname'],
            'logo' => $filePath,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return $result->save();
    }

    public function addAverageRatingCompany(float|int $averageRatingCompany, int $id): Model
    {
        $company = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->first();

        $company->fill([
            'rating_average' => $averageRatingCompany,
        ]);

        $company->save();

        return $company->first();
    }

    public function getListTopCompanies(): Collection|array
    {
        return $this->createQueryBuilder()
            ->orderBy('rating_average', 'desc')
            ->limit(10)
            ->get();
    }
}
