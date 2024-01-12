<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            @if(Request::path() == '/' || Request::path() == 'invoice')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                  <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
              </nav>
            <h1 class="mb-0 fw-bold">Invoice</h1>
            @endif
            @if(Request::path() == 'product')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                  <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
              </nav>
            <h1 class="mb-0 fw-bold">Product</h1>
            @endif
        </div>
        <div class="col-6">
            {{-- <div class="text-end upgrade-btn">
                <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/" class="btn btn-primary text-white"
                    target="_blank">Upgrade to Pro</a>
            </div> --}}
        </div>
    </div>
</div>