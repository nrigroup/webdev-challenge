
{{-- Vertical Navigation --}}
        {{-- <div class="col">
            <div class="row">
                <div class="col-3">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Inventory</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-inventory-tab" data-toggle="tab" href="#nav-inventory" role="tab" aria-controls="nav-inventory" aria-selected="true">Import / Add</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-inventory" role="tabpanel" aria-labelledby="nav-inventory-tab">

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                </div>
              </div>
        </div> --}}
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <h3 class="mt-2">Enter new Lot</h3>
        <div class="row">
            <div class="col">
                <form action="" method="post">
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="lot_title">Lot title</label>
                            <input type="text" name="lot_title" id="lot_title" class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="0">Select...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3">
                            <label for="lot_condition">Lot condition</label>
                            <select name="lot_condition" id="lot_condition" class="form-control">
                                <option value="0">Select one</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="lot_location">Lot location</label>
                            <input type="text" name="lot_location" id="lot_location" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="pre_tax_amt">Pre-tax amount</label>
                            <input type="text" name="pre_tax_amt" id="pre_tax_amt" class="form-control">
                        </div>
                        <div class="col">
                            <label for="tax_name">Tax name</label>
                            <select name="tax_name" id="tax_name" class="form-control">
                                <option value="0">Select...</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tax_amt">Tax amount</label>
                            <input type="text" name="tax_amt" id='tax_amt' class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
