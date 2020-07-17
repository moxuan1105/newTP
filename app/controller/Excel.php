<?php


namespace app\controller;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class Excel
{
    protected $spreadsheet;
    protected $sheet;

    /**
     * Excel constructor.
     * @param string $filePath
     * @param string $fileExt
     */
    public function __construct(string $filePath, string $fileExt)
    {
        try {
            $objRead = IOFactory::createReader($fileExt);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $this->spreadsheet = $objRead->load($filePath);
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    /**
     * 获取excel中的值
     * @return array
     */
    public function getExcelValue()
    {
        $highestRow = $this->sheet->getHighestRow();
        $highestColumn = $this->sheet->getHighestColumn();
        $data = [];
        for($row = 2;$row<$highestRow;$row++){
            $columnData = [];
            for ($column = 'A';$column<$highestColumn;$column++){
                $titleCell = $column.'1';
                $cell = $column.$row;
                try {
                    $columnTitle = $this->sheet->getCell($titleCell)->getValue();
                    $columnData[$columnTitle] = $this->sheet->getCell($cell)->getValue();
                } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                    $columnData['error'] = '';
                }
            }
            $data[] = $columnData;
        }
        return $data;
    }
}