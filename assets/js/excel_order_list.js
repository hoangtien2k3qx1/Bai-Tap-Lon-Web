


// excel_productList
document.getElementById('export-button_product').addEventListener('click', function() {
// Lấy dữ liệu từ bảng HTML
var table = document.querySelector('.container__table');

// Tạo một bản sao của bảng để loại bỏ các cột cuối cùng
var tableCopy = table.cloneNode(true);
var rows = tableCopy.querySelectorAll('tr');

// Lặp qua từng hàng và loại bỏ cột cuối cùng
for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].querySelectorAll('td');
    if (cells.length >= 1) {
        rows[i].removeChild(cells[cells.length - 1]); // Loại bỏ cột cuối cùng
            
    }
}

// Chuyển đổi bảng đã chỉnh sửa thành tệp Excel
var data = XLSX.utils.table_to_book(tableCopy);

// Lấy danh sách tên cột
var colNames = Object.keys(data.Sheets[data.SheetNames[0]]);

// Xét chiều dài của từng cột
for (var i = 0; i < colNames.length; i++) {
    var colName = colNames[i];
    var colWidth = { wch: 23 }; // Chiều rộng mong muốn

    // Gán chiều dài cho từng cột
    data.Sheets[data.SheetNames[0]]['!cols'][i] = colWidth;
}

// Tạo tệp Excel và lưu
XLSX.writeFile(data, 'data.xlsx');
});


