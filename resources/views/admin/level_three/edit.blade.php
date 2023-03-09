<div class="modal-header">
    <h5 class="modal-title">Update Level 3 Account</h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
    </button>
</div>
<div class="modal-body px-5">
   <div class="form-validation my-5">
    <form class="form-valide" id="update-form">
        @csrf
        @method('put')
        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="val-account">Select Account <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select class="form-control updateSearchableSelect" id="val-account" name="sub_account_id">
                    <option value="" disabled>Please select</option>
                    @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$level_three->sub_account_id==$account->id?'selected':''}}>{{$account->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="val-title">Sub Account Title<span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="{{$level_three->title}}" id="val-title" name="title" placeholder="Enter Sub account..">
            </div>
        </div>

        
        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="opening-date">Opening Date<span class="text-danger">*</span></label>
            <div class="col-lg-9">
                <input class="form-control" id="opening-date" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $level_three->date)->format('d / m / y')}}" name="opening_date" placeholder="dd/mm/yy" onkeyup="date_reformat_dd(this);" onkeypress="date_reformat_dd(this);" onpaste="date_reformat_dd(this);"  autocomplete="off" type="text">
            </div>
        </div>



    </form>
   </div>
   </div>
<div class="modal-footer">
   <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
   <button type="button" class="btn btn-success text-white" onclick="commonFunction(false,'{{ route('level3.update',$level_three->id) }}','{{route('level3.index')}}','post','','update-form');">Update</button>
</div>


<script>
    $('.updateSearchableSelectTransaction').select2({dropdownParent: $('.updateSearchableSelectTransaction').parent()});
</script>


