<?php
namespace App\Pagination;
    use Illuminate\Pagination\LengthAwarePaginator;

    class CustomPaginator extends LengthAwarePaginator
    {
        public function toArray()
        {
            return [
                "data"=>$this->items->toArray(),
                "pagination"=>[
                    "total"=>$this->total(),
                    "count"=>$this->count(),
                    "perPage"=>$this->perPage(),
                    "currentPage"=>$this->currentPage(),
                    "totalPage"=>$this->lastPage()
                ],
                ];
        }
    }
    
?>