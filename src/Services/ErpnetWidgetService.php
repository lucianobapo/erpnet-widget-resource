<?php
/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 27/08/16
 * Time: 09:53
 */

namespace ErpNET\WidgetResource\Services;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ErpnetWidgetService
{
    /**
     * @param Collection|array $dataArray
     * @param Model $dataModelInstance
     * @param string $routePrefix
     * @param array $fieldsConfig
     * @param string $layout
     * @param bool|false $hasFiles
     * @param string $method
     * @param Model|null $dataModelSelected
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function widget($dataArray = [],
                           $dataModelInstance, $routePrefix, array $fieldsConfig,
                           $layout = 'dataIndex',
                           $hasFiles = false, $method = 'POST', $dataModelSelected = null){
//        $this->authorize($jokeService->dataModelInstance());

//        $fields = $jokeService->getFillableFields();
//        foreach($fields as $key => $field){
//            if ($field=='file'){
//                $fields[$key]=[
//                    'name' => 'file',
//                    'component' => 'customFile',
//                ];
//            };
//        }
        return view('erpnetWidgetResource::'.$layout)->with([
            'data' => $dataArray,
//            'dataModelSelected' => $dataModelSelected,
            'dataModelInstance' => $dataModelInstance,
            'routePrefix' => $routePrefix,
            'fields' => $fieldsConfig,
            'customFormAttr' => [
                'route' => [
                    $routePrefix.'.store',
//                    'joke'=>$joke,
                ],
                'files' => $hasFiles,
                'method' => $method,
            ],
        ]);
    }
}