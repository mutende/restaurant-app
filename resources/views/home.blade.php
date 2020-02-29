@extends('layouts.app')
@section('title','Mealzone')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">MealZone Restaurant</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Dashboard</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/hotels">Hotels</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/menu">Menu</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/sell">Point of Sell</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/reports">Reports</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/invoice">Order from Store</router-link></li>
                            <li class="breadcrumb-item"><router-link to="/profile">Profile</router-link></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
