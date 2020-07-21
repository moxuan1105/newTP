<?php


namespace app\controller;


use app\BaseController;
use app\middleware\Auth;
use app\model\Staffs as StaffsModel;
use app\Request;
use app\validate\Staffs as StaffsValidate;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\exception\ValidateException;
use think\response\Json;

class Staffs extends BaseController
{
    protected $middleware = [Auth::class];

    public function index()
    {
        return view('index');
    }

    /**
     * 获取人员表信息
     *
     * @param Request $request
     * @return Json
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getList(Request $request)
    {
        $prePare = pagePrepare($request);
        $page = $prePare[0];
        $limit = $prePare[1];

        $count = StaffsModel::count();
        $result = StaffsModel::limit($page, $limit)->select();

        if ($result->isEmpty()) {
            $result = [];
            $count = 0;
        }

        return json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $result
        ]);
    }

    /**
     * 人员表搜索
     *
     * @param Request $request
     * @return Json
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function search(Request $request)
    {
        $searchOptions = $request->param('options');
        $searchValue = $request->param('value');

        // 如果搜索值为空 则返回默认全部选择
        if (empty($searchValue)) {
            return $this->getList($request);
        }

        $prePare = pagePrepare($request);
        $page = $prePare[0];
        $limit = $prePare[1];

        $count = StaffsModel::where($searchOptions, 'like', $searchValue . '%')->count();
        $result = StaffsModel::where($searchOptions, 'like', $searchValue . '%')->limit($page, $limit)->select();

        if ($result->isEmpty()) {
            $result = [];
            $count = 0;
        }

        return json([
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $result
        ]);
    }

    /**
     * 添加新的人员信息
     *
     * @param Request $request
     * @return Json
     */
    public function store(Request $request)
    {
        $data = $request->param();
        $tokenCheck = $request->checkToken('__token__', $data);

        $token = createToken($request);
        if (false == $tokenCheck) {
            return json([0, $token, '表单错误']);
        }

        try {
            validate(StaffsValidate::class)->check($data);
        } catch (ValidateException $e) {
            return json([0, $token, $e->getError()]);
        }

        $staffs = StaffsModel::create($data);

        if ($staffs->isEmpty()) {
            return json([0, $token, '数据添加失败']);
        }

        return json([1, $token, '数据添加成功']);
    }

    public function upload(Request $request)
    {
        $field = $request->param('field');
        $fileUpload = new FileUpload();
        $uploadResult = $fileUpload->upload($field);

        if(false == $uploadResult[0]){
            return $uploadResult;
        }

        $fileExtArray = ['xls','xlsx','csv'];

        $fileExt = $uploadResult['fileExt'];
        if(!in_array($fileExt,$fileExtArray)){
            unlink($uploadResult['savePath']);
            return json([false,'文件类型不匹配']);
        }
        $excel = new ExcelReader($uploadResult['savePath'],$uploadResult['fileExt']);
        $data = $excel->getExcelValue();
        return json($data);
    }
}