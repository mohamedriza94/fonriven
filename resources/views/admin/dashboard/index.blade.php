@extends('layouts.adminMaster')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0" id="wholePage">
            
            <div class="row layout-top-spacing">
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                    <div class="widget widget-activity-four">
                        <div class="widget-content">
                            <h1 class="text-dark text-uppercase">SUPERVISOR</h1>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                    <div class="widget widget-activity-four">
                        <div class="widget-content">
                            <button class="btn btn-secondary col-12" id="btnPDF_all">Download PDF of Whole Report</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-three">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Active Workforce</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="workforce"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Workshops</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="workshop"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Workstations</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="workstation"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Pending Kanban Cards</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="kanbanCard"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Pending Tasks</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="task"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-primary">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white">Pending Restock Requests</h6>
                                            </div>
                                        </td>
                                        <td class="bg-danger">
                                            <div class="form-check form-check-primary">
                                                <h6 class="mb-0 text-white" id="inventoryRequest"></h6>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
                    <div class="widget widget-three">
                        <div class="widget-heading">
                            <h5 class="">Raw Materials</h5>
                        </div>
                        <div class="widget-content">
                            
                            <div class="order-summary" id="rawMaterialsData">
                                
                                
                                
                                
                                
                                
                                
                            </div>
                            
                            <hr class="border-dark">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-danger col-3" id="btnPrev_rawMaterials">Prev</button>
                                <button class="btn btn-primary col-3" id="btnNext_rawMaterials">Next</button>
                                <button class="btn btn-warning col-2" id="btnAll_rawMaterials">All</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing" id="">
                    <div class="widget widget-three">
                        <div class="widget-heading">
                            <h5 class="">Kanban Cards</h5>
                        </div>
                        <div class="widget-content">
                            
                            <div class="order-summary" id="cards">
                                
                            </div>
                            
                            <hr class="border-dark">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-danger col-2" id="btnPrev_cards">Prev</button>
                                <button class="btn btn-primary col-2" id="btnNext_cards">Next</button>
                                <button class="btn btn-warning col-2" id="btnAll_cards">All</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">
                        
                        <div class="widget-heading">
                            <h5 class="">Tasks</h5>
                        </div>
                        
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">No.</div></th>
                                            <th><div class="th-content">Title</div></th>
                                            <th><div class="th-content">Start</div></th>
                                            <th><div class="th-content">Deadline</div></th>
                                            <th><div class="th-content">Status</div></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tasksData">
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            <hr class="border-dark">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-danger col-3" id="btnPrev_tasks">Prev</button>
                                <button class="btn btn-primary col-3" id="btnNext_tasks">Next</button>
                                <button class="btn btn-warning col-2" id="btnAll_tasks">All</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">
                        
                        <div class="widget-heading">
                            <h5 class="">Restock Request</h5>
                        </div>
                        
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Request No.</div></th>
                                            <th><div class="th-content">Date</div></th>
                                            <th><div class="th-content">Time</div></th>
                                            <th><div class="th-content">Quantity</div></th>
                                            <th><div class="th-content">Cost (AUD)</div></th>
                                            <th><div class="th-content">Request Status</div></th>
                                        </tr>
                                    </thead>
                                    <tbody id="restockData">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        <hr class="border-dark">
                        <div class="d-flex align-items-center justify-content-between">
                            <button class="btn btn-danger col-3" id="btnPrev_restock">Prev</button>
                            <button class="btn btn-primary col-3" id="btnNext_restock">Next</button>
                            <button class="btn btn-warning col-2" id="btnAll_restock">All</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">
                        
                        <div class="widget-heading">
                            <h5 class="">Workshop Worker Status</h5>
                        </div>
                        
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Worker No.</div></th>
                                            <th><div class="th-content">Name</div></th>
                                            <th><div class="th-content">Total Tasks Done</div></th>
                                            <th><div class="th-content">Currently Working On</div></th>
                                            <th><div class="th-content">Highest Speed</div></th>
                                        </tr>
                                    </thead>
                                    <tbody id="workerData">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <hr class="border-dark">
                        <div class="d-flex align-items-center justify-content-between">
                            <button class="btn btn-danger col-3" id="btnPrev_worker">Prev</button>
                            <button class="btn btn-primary col-3" id="btnNext_worker">Next</button>
                            <button class="btn btn-warning col-2" id="btnAll_worker">All</button>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    @endsection
    
    @section('scripts')
    @endsection
