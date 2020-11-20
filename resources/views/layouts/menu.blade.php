@extends('layouts.dashboard')

@section('body')
<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                        <div class="dropdown profile-element"> 
                            
                        </div>
                        <div class="logo-element">
                                Panel
                        </div>
                </li>
                <li {{ (Request::is('*home') ? 'class=active' : '') }}>
                    <a href="{{ url ('home') }}"><i class="fas fa-briefcase"></i> <span class="nav-label">Empleados</span></a>
                </li>
                <li>
                    <a href="{{ url ('logout') }}"><i class="fas fa-arrow-circle-left"></i> <span class="nav-label">Cerrar sesión</span></a>
                </li>
            </ul>

        </div>
    </nav>
       

    <div id="page-wrapper" class="gray-bg" style="min-height: 1359px;">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right" style="margin-top: 20px;">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Hola {{ Auth::user()->name }}!</span>
                    </li>
                </ul>
            </nav>
        </div>
        
        @yield('section')

        <!-- /#page-wrapper -->
    </div>
</div>
@stop

