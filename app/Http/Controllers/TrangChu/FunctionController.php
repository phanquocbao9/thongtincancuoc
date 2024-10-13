<?php

namespace App\Http\Controllers\Trangchu;

use App\Http\Controllers\Controller;
use App\Models\CCCD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class FunctionController extends Controller
{
    //Thêm thông tin vào csdl
    public function addCCCD(Request $request)
    {
        try {
            // Kiểm tra xem id_cccd có tồn tại trong cơ sở dữ liệu không
            $existingCCCD = CCCD::where('id_cccd', $request->input('id'))->first();

            if ($existingCCCD) {
                // Nếu tồn tại, trả về thông báo trùng lặp
                return response()->json([
                    'success' => false,
                    'error' => 'ID CCCD đã tồn tại trong hệ thống. Vui lòng kiểm tra lại.'
                ], 400); // 400 là mã lỗi yêu cầu không hợp lệ
            }

            // Nếu không trùng lặp, tạo đối tượng mới cho CCCD
            $cccd = new CCCD();
            $cccd->name_cccd = $request->input('name');
            $cccd->id_cccd = $request->input('id');
            $cccd->sex_cccd = $request->input('sex');
            $cccd->nationality_cccd = $request->input('nationality');
            $cccd->home_cccd = $request->input('home');
            $cccd->address_cccd = $request->input('address');
            $cccd->features_cccd = $request->input('features');
            $cccd->dob_cccd = $request->input('dob'); // Ngày sinh
            $cccd->issue_cccd = $request->input('issue_date'); // Ngày cấp
            $cccd->doe_cccd = $request->input('doe'); // Ngày hết hạn

            // Lưu dữ liệu CCCD
            $cccd->save();

            // Cập nhật stt cho các bản ghi CCCD
            $cccdList = CCCD::orderBy('stt_cccd')->get();
            foreach ($cccdList as $key => $cc) {
                $cc->stt_cccd = $key + 1;
                $cc->save();
            }

            // Trả về thông báo thành công
            return response()->json(['success' => true]);

        } catch (\Exception $exception) {
            // Ghi lại lỗi
            Log::error('Lỗi khi thêm loại CCCD: ' . $exception->getMessage());

            // Trả về thông báo lỗi với chi tiết
            return response()->json(['success' => false, 'error' => 'Đã xảy ra lỗi: ' . $exception->getMessage()], 500);
        }
    }


    // Xuất file Word
    public function exportToWord(Request $request)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Định nghĩa kiểu chữ cho tiêu đề và nội dung
        $titleFontStyle = ['bold' => true, 'size' => 16];
        $contentFontStyle = ['size' => 13];

        // Định dạng lại các ngày tháng từ định dạng `YYYY-MM-DD` sang `dd/mm/yyyy`
        $dob = \DateTime::createFromFormat('Y-m-d', $request->dob)->format('d/m/Y');
        $issue_date = \DateTime::createFromFormat('Y-m-d', $request->issue_date)->format('d/m/Y');
        $doe = \DateTime::createFromFormat('Y-m-d', $request->doe)->format('d/m/Y');

        // Thêm tiêu đề và nội dung
        $section->addText('Thông Tin Căn Cước', $titleFontStyle, ['alignment' => Jc::CENTER]);
        $section->addText("• Số: " . $request->id, $contentFontStyle);
        $section->addText("• Họ và tên: " . $request->name, $contentFontStyle);
        $section->addText("• Ngày sinh: " . $dob, $contentFontStyle);
        $section->addText("• Giới tính: " . $request->sex, $contentFontStyle);
        $section->addText("• Quốc tịch: " . $request->nationality, $contentFontStyle);
        $section->addText("• Quê quán: " . $request->home, $contentFontStyle);
        $section->addText("• Nơi thường trú: " . $request->address, $contentFontStyle);
        $section->addText("• Đặc điểm nhận dạng: " . $request->features, $contentFontStyle);
        $section->addText("• Ngày cấp: " . $issue_date, $contentFontStyle);
        $section->addText("• Ngày hết hạn: " . $doe, $contentFontStyle);

        // Lưu file tạm thời
        $fileName = 'ThongTinCanCuoc.docx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $phpWord->save($temp_file, 'Word2007');

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    // Xuất file Excel
    public function exportToExcel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt tiêu đề cho bảng tính
        $sheet->setCellValue('A1', 'Thông Tin Căn Cước');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Định dạng lại các ngày tháng từ định dạng `YYYY-MM-DD` sang `dd/mm/yyyy`
        $dob = \DateTime::createFromFormat('Y-m-d', $request->dob)->format('d/m/Y');
        $issue_date = \DateTime::createFromFormat('Y-m-d', $request->issue_date)->format('d/m/Y');
        $doe = \DateTime::createFromFormat('Y-m-d', $request->doe)->format('d/m/Y');

        // Thêm thông tin vào các ô
        $sheet->setCellValue('A2', 'Số:')->setCellValue('B2', $request->id);
        $sheet->setCellValue('A3', 'Họ và tên:')->setCellValue('B3', $request->name);
        $sheet->setCellValue('A4', 'Ngày sinh:')->setCellValue('B4', $dob);
        $sheet->setCellValue('A5', 'Giới tính:')->setCellValue('B5', $request->sex);
        $sheet->setCellValue('A6', 'Quốc tịch:')->setCellValue('B6', $request->nationality);
        $sheet->setCellValue('A7', 'Quê quán:')->setCellValue('B7', $request->home);
        $sheet->setCellValue('A8', 'Nơi thường trú:')->setCellValue('B8', $request->address);
        $sheet->setCellValue('A9', 'Đặc điểm nhận dạng:')->setCellValue('B9', $request->features);
        $sheet->setCellValue('A10', 'Ngày cấp:')->setCellValue('B10', $issue_date);
        $sheet->setCellValue('A11', 'Ngày hết hạn:')->setCellValue('B11', $doe);

        // Tạo file Excel và lưu tạm thời
        $fileName = 'ThongTinCanCuoc.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    // Xuất file PDF
    public function exportToPDF(Request $request)
    {
        // Định dạng lại các ngày tháng từ định dạng `YYYY-MM-DD` sang `dd/mm/yyyy`
        $dob = \DateTime::createFromFormat('Y-m-d', $request->dob)->format('d/m/Y');
        $issue_date = \DateTime::createFromFormat('Y-m-d', $request->issue_date)->format('d/m/Y');
        $doe = \DateTime::createFromFormat('Y-m-d', $request->doe)->format('d/m/Y');

        // Dữ liệu để xuất
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'dob' => $dob,
            'sex' => $request->sex,
            'nationality' => $request->nationality,
            'home' => $request->home,
            'address' => $request->address,
            'features' => $request->features,
            'issue_date' => $issue_date,
            'doe' => $doe,
        ];

        Log::info($request->all());

        // Tạo view cho file PDF
        $pdf = PDF::loadView('pdf_template', $data);

        // Tải file PDF xuống
        return $pdf->download('ThongTinCanCuoc.pdf');
    }
}
