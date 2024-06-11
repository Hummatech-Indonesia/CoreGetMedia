<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\SubCategoryInterface;
use App\Enums\NewsStatusEnum;
use App\Models\Category;
use App\Models\News;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            $news = News::latest()->take(10)->where('status', NewsStatusEnum::ACTIVE->value)->get();
            $additionalData = [
               'categories' => Category::all(),
               'subCategories'=> SubCategory::all(),
               'news'=>$news
            ];

            return response()->view('error.404', $additionalData, 404);
        }

        return parent::render($request, $exception);
    }
}
