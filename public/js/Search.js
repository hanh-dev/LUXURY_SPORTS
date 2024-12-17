//lắng nghe sự kiện click
document.getElementById('searchIcon').addEventListener('click', function (e) {
    e.preventDefault(); //ngăn chuyển trang
    const searchContainer = document.getElementById('searchContainer');

    //hiển thị thanh tìm kiếm
    if (searchContainer.style.display === 'none' || searchContainer.style.display === '') {
        searchContainer.style.display = 'block';
    } else {
        searchContainer.style.display = 'none';
    }
});