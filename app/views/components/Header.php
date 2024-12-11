<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Link Header css -->
    <link rel="stylesheet" href="public/css/Header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Header</title>
</head>
<body>
    <div class="site_header">
        <div class="header-box">
            <!-- Header right -->
            <div class="header_right">
                <div class="branch_name">
                    <h3>LUXURY_SPORTS</h3>
                </div>
            </div>
            <!-- Header center -->
            <div class="header_center">
                <nav class="main_navigation">
                    <ul class="menu-main-menu">
                        <!-- Home -->
                        <li class="menu-item">
                            <a href="#">
                                <span>Home</span>
                            </a>
                        </li>
                        <!-- Category -->
                        <li class="menu-item">
                            <a href="#">
                                <span>Category</span>
                                <i class="fa-solid fa-arrow-down"></i>
                            </a>
                            <ul class="sub_menu">
                                <li class="sub_menu-item">
                                    <a href="#">Football</a>
                                </li>
                                <li class="sub_menu-item">
                                    <a href="#">Basketball</a>
                                </li>
                                <li class="sub_menu-item">
                                    <a href="#">Tennis</a>
                                </li>
                                <li class="sub_menu-item">
                                    <a href="#">Pickleball</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                <span>About Us</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                <span>Contact Us</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Header left -->
            <div class="header_left">
                <div class="elementor-widget-container">
                    <div class="kitify-menu_account">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><g clip-path="url(#clip0_312_1296)"><path d="M0.833313 19.8408C0.833313 15.2383 4.56415 11.5075 9.16665 11.5075H10.8333C15.4358 11.5075 19.1666 15.2383 19.1666 19.8408" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10 11.5075C12.7614 11.5075 15 9.26893 15 6.50751C15 3.74608 12.7614 1.50751 10 1.50751C7.23858 1.50751 5 3.74608 5 6.50751C5 9.26893 7.23858 11.5075 10 11.5075Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                    </div>
                    <div class="kitify-search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><path d="M18.4375 19.1117L13.2988 13.973" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.4375 15.9867C12.2345 15.9867 15.3125 12.9087 15.3125 9.11169C15.3125 5.31474 12.2345 2.23669 8.4375 2.23669C4.64054 2.23669 1.5625 5.31474 1.5625 9.11169C1.5625 12.9087 4.64054 15.9867 8.4375 15.9867Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <div class="kitify-cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.93521 0.674194C7.34848 0.674194 5.21257 2.60307 4.88701 5.10128H4.30035C3.41875 5.10125 2.68767 5.10122 2.11391 5.1814C1.51073 5.26567 0.968741 5.45177 0.556553 5.91229C0.144361 6.37282 0.0192607 6.93205 0.00210754 7.54084C-0.0142098 8.11995 0.0665473 8.84655 0.16393 9.72271L0.436543 12.1762C0.640216 14.0094 0.800175 15.4491 1.07187 16.5681C1.35035 17.7151 1.76454 18.6103 2.53348 19.2985C3.30315 19.9873 4.243 20.2998 5.42007 20.4497C6.56928 20.5961 8.02857 20.5961 9.88784 20.5961H9.98258C11.8418 20.5961 13.3011 20.5961 14.4503 20.4497C15.6274 20.2998 16.5672 19.9873 17.3369 19.2985C18.1058 18.6103 18.52 17.7151 18.7985 16.5681C19.0702 15.4491 19.2301 14.0095 19.4339 12.1763L19.7065 9.72271C19.8038 8.84655 19.8846 8.11994 19.8683 7.54084C19.8511 6.93205 19.7261 6.37282 19.3138 5.91229C18.9017 5.45177 18.3597 5.26567 17.7565 5.1814C17.1827 5.10122 16.4516 5.10125 15.57 5.10128H14.9834C14.658 2.60328 12.5219 0.674194 9.93521 0.674194ZM9.93521 2.00232C11.7869 2.00232 13.3262 3.33973 13.6398 5.10128H6.23052C6.54403 3.33992 8.08354 2.00232 9.93521 2.00232ZM1.54617 6.79805C1.66191 6.66874 1.84555 6.55992 2.2977 6.49674C2.76869 6.43093 3.40618 6.4294 4.34935 6.4294H15.521C16.4642 6.4294 17.1017 6.43093 17.5726 6.49674C18.0248 6.55992 18.2085 6.66874 18.3242 6.79805C18.4399 6.92735 18.5278 7.12189 18.5407 7.57825C18.554 8.05362 18.4852 8.68738 18.381 9.62478L18.1191 11.9823C17.909 13.873 17.7572 15.2281 17.5079 16.2548C17.2631 17.2631 16.9428 17.8687 16.4512 18.3089C15.9602 18.7483 15.32 19.0001 14.2825 19.1322C13.2269 19.2667 11.8521 19.2679 9.93521 19.2679C8.01824 19.2679 6.64348 19.2667 5.58788 19.1322C4.55038 19.0001 3.91021 18.7483 3.41923 18.3089C2.92752 17.8687 2.60731 17.2631 2.36249 16.2548C2.11321 15.2281 1.96137 13.873 1.75129 11.9823L1.48935 9.62478C1.38519 8.68738 1.31631 8.05362 1.32971 7.57825C1.34256 7.12189 1.43044 6.92735 1.54617 6.79805Z" fill="currentColor"></path><path d="M15.2477 9.30699C15.2477 9.796 14.8512 10.1924 14.3623 10.1924C13.8733 10.1924 13.4769 9.796 13.4769 9.30699C13.4769 8.81799 13.8733 8.42157 14.3623 8.42157C14.8512 8.42157 15.2477 8.81799 15.2477 9.30699Z" fill="currentColor"></path><path d="M6.39351 9.30699C6.39351 9.796 5.9971 10.1924 5.5081 10.1924C5.0191 10.1924 4.62268 9.796 4.62268 9.30699C4.62268 8.81799 5.0191 8.42157 5.5081 8.42157C5.9971 8.42157 6.39351 8.81799 6.39351 9.30699Z" fill="currentColor"></path></svg>
                        <div class="cart_text">
                            <div class="count_badge">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>