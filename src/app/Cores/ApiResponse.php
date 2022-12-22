<?php
namespace App\Cores;
use File;
use Response;

trait ApiResponse {
    /**
     * Renponse Variables
     * @var array
     */
    public $response = [
        'error' => [
            'data' => [
                'status' => false,
                'message' => 'Something Wrong.'
            ],
            'code' => 400
        ],
        'unauth' => [
            'data' => [
                'status' => false,
                'message' => 'Something Wrong.'
            ],
            'code' => 401
        ],
        'pagination' => [
            'data' => [
                'data' => []
            ],
            'code' => 200
        ],
        'default' => [
            'data' => [
                'status' => true,
                'message' => 'OK',
                'data' => []
            ],
            'code' => 200
        ]
    ];

    /**
     * Renponse Json
     * @param String $type
     * @param String $message
     * @param Array/Object $data
     * @param String/Int $code
     * @param String/Int $sort
     * @return Json
     */
    public function responseJson($type='default', $message='', $data = [], $code='', $sort = [])
    {
        switch ($type) {
            case 'error':
                $response = $this->response[$type];
                break;
            case 'deleted':
                $response = $this->response[$type];
                break;
            case 'unauth':
                $response = $this->response[$type];
                break;
            default:
                $response = $this->response['default'];
                break;
        }

        if ($type != 'pagination') {
            if (!empty($message)) {
                $response['data']['message'] = $message;
            }
            if (!empty($data)){
                $response['data']['data'] = $data;
            } else {
                unset($response['data']['data']);
            }
        }

        if (!empty($code)) {
            $response['code'] = $code;
        }

        return response()
            ->json($response['data'], $response['code']);
    }
}
