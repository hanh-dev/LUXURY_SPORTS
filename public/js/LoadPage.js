async function loadPage(page) {
    try {
        // Lấy phần tử để cập nhật nội dung
        const contentArea = document.getElementById('content');
        
        // Gửi yêu cầu fetch để tải nội dung của trang
        const response = await fetch('/LUXURY_SPORTS/' + page);
        const html = await response.text();
        contentArea.innerHTML = html;

        // Cập nhật URL và title mà không reload trang
        window.history.pushState({ page: page }, page, '/LUXURY_SPORTS/' + page);  // Đảm bảo URL có '/LUXURY_SPORTS/' trước tên trang

        // Cập nhật title của trang
        document.title = page + " - My Website";  // Tên trang có thể tùy chỉnh

    } catch (error) {
        console.error('Error loading page:', error);
    }
}

// Hàm gắn sự kiện cho các nút bằng cách sử dụng Event Delegation
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('header').addEventListener('click', (event) => {
        // Kiểm tra nếu phần tử click có id là getHome
        if (event.target && event.target.id === 'getHome') {
            loadPage('Home');
        }
        // Kiểm tra nếu phần tử click có id là getAbout
        else if (event.target && event.target.id === 'getAbout') {
            loadPage('AboutUs');
        }
        // Kiểm tra nếu phần tử click có id là getContactUs
        else if (event.target && event.target.id === 'getContactUs') {
            loadPage('ContactUs');
        }
    });
});
