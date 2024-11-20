<?php


namespace App\Repositories;



use App\Contracts\NewsLetterContract;
use App\Models\NewsLetter;

use app\Traits\UploadAble;
use JetBrains\PhpStorm\Pure;

class NewsLetterRepository extends BaseRepositories implements NewsLetterContract
{
    use UploadAble;

    /**
     * @param NewsLetter $model
     * @param array $filters
     */
    #[Pure]
    public function __construct(NewsLetter $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }
}
