<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('employee.list') }}">
                    <i class="fa fa-circle-o"></i> <span>Employee</span>
                </a>
            </li>
            <li>
                <a href="{{ route('position.list') }}">
                    <i class="fa fa-circle-o"></i> <span>Position</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee-position.list') }}">
                    <i class="fa fa-circle-o"></i> <span>Employee Position</span>
                </a>
            </li>
            <li>
                <a href="{{ route('approval.list') }}">
                    <i class="fa fa-circle-o"></i> <span>Approval</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mail') }}">
                    <i class="fa fa-circle-o"></i> <span>Mail</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>