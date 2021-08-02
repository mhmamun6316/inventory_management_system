<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Inventory Management System</title>
        <link href="{{asset('backend/css/styles.css')}}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <div id="app">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" v-show="$route.path === '/' || $route.path === '/register' || $route.path ==='/forget' ? false : true ">
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <!-- Navbar-->
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#">Activity Log</a>
                            <div class="dropdown-divider"></div>
                            <router-link class="dropdown-item" to="/logout">Logout</router-link>
                        </div>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav" v-show="$route.path === '/' || $route.path === '/register' || $route.path ==='/forget' ? false : true ">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">

                                <router-link class="nav-link" to="/home">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-2x"></i></div>
                                    Dashboard
                                </router-link>

                                <router-link class="nav-link bg-danger" to="/pos">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cart-plus fa-2x"></i></div>
                                    <span class="text-white"><b>POS</b></span>
                                </router-link>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-circle fa-2x"></i></div>
                                    <span>Employee</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/employee">Add Employee</router-link>
                                        <router-link class="nav-link" to="/all/employee">All Employee</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="far fa-user-circle fa-2x"></i></div>
                                    <span>Suppliers</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/supplier">Add Suppliers</router-link>
                                        <router-link class="nav-link" to="/all/supplier">All Suppliers</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts22" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="far fa-user fa-2x"></i></div>
                                    <span>Customers</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts22" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/customer">Add Customers</router-link>
                                        <router-link class="nav-link" to="/all/customer">All Customers</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-certificate fa-2x"></i></div>
                                    <span>Categories</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/category">Add Categories</router-link>
                                        <router-link class="nav-link" to="/all/category">All Categories</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-suitcase-rolling fa-2x"></i></div>
                                    <span>Products</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/product">Add Products</router-link>
                                        <router-link class="nav-link" to="/all/product">All Products</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="far fa-lightbulb fa-2x"></i></div>
                                    <span>Expenses</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/create/expense">Add Expense</router-link>
                                        <router-link class="nav-link" to="/today/expense">All Expenses</router-link>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign fa-2x"></i></div>
                                    <span>Salaries</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/given/salary">Pay Salary</router-link>
                                        <router-link class="nav-link" to="/all/salary">All Salary</router-link>
                                    </nav>
                                </div>

                                <router-link class="nav-link" to="/stock">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes fa-2x"></i></div>
                                 <span class="ml-1">Stock</span>
                                </router-link>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts17" aria-expanded="false" aria-controls="collapseLayouts">
                                     <div class="sb-nav-link-icon"><i class="fas fa-shopping-basket fa-2x"></i></div>
                                    <span>Orders</span>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts17" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <router-link class="nav-link" to="/order">Today Order</router-link>
                                        <router-link class="nav-link" to="/search/order">Search Order</router-link>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
        <script src="{{asset('backend/js/scripts.js')}}"></script>
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="{{asset('backend/assets/demo/chart-area-demo.js')}}"></script>-->
<!--        <script src="{{asset('backend/assets/demo/chart-bar-demo.js')}}"></script>-->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend/assets/demo/datatables-demo.js')}}"></script>
    </body>
</html>