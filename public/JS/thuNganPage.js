function setChoseTable(number){
    sobanCu = document.getElementById("banDuocChon").value;
    banCu = document.getElementById("ban-"+sobanCu);

    // chuyển màu của bàn cũ thành màu bình thường
    banCu.classList.remove("bg-info");
    banCu.classList.add("bg-secondary");

    // Chuyển màu của bàn mới thành màu nổi bậc
    banMoi = document.getElementById("ban-" + number);
    banMoi.classList.remove("bg-secondary");
    banMoi.classList.add("bg-info");
    
    // Set thông tin label và input lưu dữ liệu bàn
    document.getElementById('soBan').innerText = "Bàn "+number;
    inputBan = document.getElementById('banDuocChon');
    inputBan.value = number;
}

function toggleBetweenBanAndthucDon(destination){
    if(destination === 'Ban'){
        document.getElementById('thucDon-tab').style.display = 'none';
        document.getElementById('ban-tab').style.display = 'flex';
    } else if (destination === 'thucDon') {
        document.getElementById('ban-tab').style.display = 'none';
        document.getElementById('thucDon-tab').style.display = 'flex';
    }
}

function kiemTraTonTai (idMon){
    mon = document.getElementById('tableHienThiCacMon-body').children;
    for (var i=0; i<mon.length; i++) {
        if (mon[i].children[5].children[0].name == idMon) {
            return true;
        }
    }
    return false;
}

// Thêm món mới vào bảng
function setGiaTriChoBangVaForm(id_mon){
    tenMon = document.getElementById(id_mon).children[0].innerText;
    giaMon = document.getElementById(id_mon).children[1].innerText;

    // Kiểm tra món đã tồn tại trong bảng chưa
    if(kiemTraTonTai(id_mon)){
        alert("Món đã được thêm trong bảng, vui lòng chọn món khác");
    } else {
            // Điền dữ liệ vào bảng  
        tableHienThi = document.getElementById('tableHienThiCacMon-body');
        row = document.createElement('tr');

        tdTen = document.createElement('td');
        // tdTen.setAttribute('scope', 'row');
        tdTen.innerHTML = tenMon.trim();
        row.appendChild(tdTen);

        tdSoLuong = document.createElement('td');
        inputSoLuong = document.createElement('input');
        // inputSoLuong.setAttribute('id', "soLuongMon" + id_mon);
        inputSoLuong.setAttribute("onchange", "thayDoiTongTienCuaMon('" + tenMon.trim() + "')");
        inputSoLuong.setAttribute("type", "number");
        // inputSoLuong.setAttribute("name", id_mon);
        inputSoLuong.setAttribute("value", 1);
        tdSoLuong.appendChild(inputSoLuong);
        row.appendChild(tdSoLuong);

        tdDonGia = document.createElement('td');
        tdDonGia.innerHTML = giaMon;
        row.appendChild(tdDonGia);

        tdThanhTien = document.createElement('td');
        tdThanhTien.innerHTML = giaMon;
        row.appendChild(tdThanhTien);

        tdDelete = document.createElement('td');
        deleteButton = document.createElement('i');
        deleteButton.setAttribute('class', 'fa-solid fa-trash');
        deleteButton.setAttribute('onclick', "xoaMon(\'"+tenMon.trim()+"'\)");
        tdDelete.appendChild(deleteButton);
        row.appendChild(tdDelete);

        tdIdMon = document.createElement('td');
        inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = id_mon;
        inputId.value = 1;
        tdIdMon.appendChild(inputId);
        row.appendChild(tdIdMon);

        tableHienThi.appendChild(row);
        //

        // Sau khi thêm món mới phải tính lại tổng tiền
        tinhTongTienPageThuNgan();
    }
}

function xoaMon(tenMon){
    console.log("Đã xóa");
    mon = document.getElementById('tableHienThiCacMon-body').children;
    for (var i=0; i<mon.length; i++) {
        console.log(mon[i].children[0].textContent);
        if (mon[i].children[0].textContent === tenMon) {
            mon[i].remove();
        }
    }
    // Sau khi thêm món mới phải tính lại tổng tiền
    tinhTongTienPageThuNgan();
}

// Thay đổi trường thành tiền và trường value của input gửi dữ liệu về server
//  ở Món bị chỉnh sửa số lượng
function thayDoiTongTienCuaMon (tenMon){
    mon = document.getElementById('tableHienThiCacMon-body').children;
    console.log(tenMon);
    for (var i=0; i<mon.length; i++) {
        console.log(mon[i].children[0].textContent);
        if (tenMon.includes(mon[i].children[0].textContent)) {
            soLuong = parseFloat(mon[i].children[1].children[0].value);
            gia = parseFloat(mon[i].children[2].textContent);
            mon[i].children[3].innerText = soLuong * gia;
            mon[i].children[5].children[0].value = soLuong;

            if(mon[i].children[1].children[0].value == 0)
                mon[i].remove();
        }
    }
    // Sau khi thêm món mới phải tính lại tổng tiền
    tinhTongTienPageThuNgan();
}

// Tính tổng tiền của những Món đã hiện trên bảng
function tinhTongTienPageThuNgan(){
    mon = document.getElementById('tableHienThiCacMon-body').children;
    tongTienPageThuNgan = 0.0;
    for (var i=0; i<mon.length; i++) {
        tongTienPageThuNgan += parseFloat(mon[i].children[3].innerText);
    }
    document.getElementById("thuNganPage-tongTien").innerHTML = "Tổng tiền: " + tongTienPageThuNgan;
}

// Kiểm tra người dùng có thêm món vào trước khi submit hay không
function ktraHoaDonRong(event){
    event.preventDefault();
    if(mon = document.getElementById('tableHienThiCacMon-body').children.length == 0) {
        alert('Hãy nhập vào ít nhất 1 món trước khi thanh toán');
    } else {
        form = document.getElementById("thuNgan-Form-postValue");
        form.submit();
    }
    
}

// 
function searchAndFillDataThuNgan(){
    keyword = document.getElementById("thuNgan-Search-input").value;
    console.log(keyword);
    url = '/DSMon/'+keyword;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        tabHienThuMenu = document.getElementById('thucDon-list');
        tabHienThuMenu.innerHTML = "";
        for (var i in data) {
            div = document.createElement('div');
            div.setAttribute('class', 'col');
            item = document.createElement('div');
            item.setAttribute('id', data[i].id);
            item.setAttribute('class', "thucDon-img");
            item.setAttribute('onclick', "setGiaTriChoBangVaForm("+ data[i].id +")");
            item.setAttribute('style', 'background-image: url(' + data[i].imgsp + ');');
            gia = document.createElement('span');
            gia.setAttribute('class', 'thucDon-giaMon bg-info');
            gia.innerText = data[i].giasp;
            item.appendChild(gia);
            tenMon = document.createElement('span');
            tenMon.setAttribute('class', 'thucDon-tenMon bg-info');
            tenMon.innerText = data[i].tensp;
            item.appendChild(tenMon);
            div.appendChild(item);
            tabHienThuMenu.appendChild(div);
        }
    });
}