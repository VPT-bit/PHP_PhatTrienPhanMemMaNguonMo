<ul
  class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
  id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a
    class="sidebar-brand d-flex align-items-center justify-content-center"
    href="index_admin.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index_admin.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Thống kê</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->
  <div class="sidebar-heading">Quản lý</div>

  <li class="nav-item">
    <a
      class="nav-link collapsed"
      href="#"
      data-toggle="collapse"
      data-target="#collapseProducts"
      aria-expanded="true"
      aria-controls="collapseProducts">
      <i class="fas fa-fw fa-folder"></i>
      <span>Quản lý sản phẩm</span>
    </a>
    <div
      id="collapseProducts"
      class="collapse"
      aria-labelledby="headingProducts"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Sản phẩm:</h6>
        <a
          class="collapse-item"
          href="index_admin.php?page=list_product">Danh sách sản phẩm</a>
        <a class="collapse-item" href="product_list.php">Danh sách loại sản phẩm</a>
        <a class="collapse-item" href="product_list.php">Danh sách thương hiệu</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a
      class="nav-link collapsed"
      href="#"
      data-toggle="collapse"
      data-target="#collapseCustomer"
      aria-expanded="true"
      aria-controls="collapseCustomer">
      <i class="fas fa-fw fa-folder"></i>
      <span>Quản lý khách hàng</span>
    </a>
    <div
      id="collapseCustomer"
      class="collapse"
      aria-labelledby="headingCustomers"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Sản phẩm:</h6>
        <a class="collapse-item" href="product_list.php">Danh sách</a>
        <a class="collapse-item" href="add_product.php">Thêm sản phẩm</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block" />

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>