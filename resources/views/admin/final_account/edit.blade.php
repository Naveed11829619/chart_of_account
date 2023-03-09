<div class="modal-header">
    <h5 class="modal-title">Update Final Account</h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
    </button>
</div>
<div class="modal-body px-5">
   <div class="form-validation my-5">
    <form class="form-valide" id="update-form">
        @csrf
        @method('put')
        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="val-account">Select Sub Account <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select class="form-control updateSearchableSelect" id="val-account" name="level_three_id">
                    <option value="" disabled>Please select</option>
                    @foreach ($accounts as $account)
                        <option value="{{$account->id}}" {{$final_account->level_three_id==$account->id?'selected':''}}>{{$account->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="val-title">Final account title<span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="{{$final_account->title}}" id="val-title" name="title" placeholder="Enter Final account..">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="opening-balance">Opening Balance<span class="text-danger">*</span></label>
            <div class="col-lg-9">
                <div class="row m-0">
                    <div class="col-6 pl-0">
                        <input type="text" class="form-control" id="opening-balance" value="{{number_format($final_account->opening_balance)}}"  name="opening_balance" placeholder="Enter Opening Balance.."  maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" data-val="{{$final_account->opening_balance}}" data-common="common" onkeyup="getValue(this)">
                    </div>
                    <div class="col-6 pr-0">
                        <select class="form-control updateSearchableSelectTransaction" id="transaction-type" name="transaction_type">
                            <option value="" disabled>Select Debit/Credit</option>
                            <option value="debit" @if($final_account->transaction_type=='debit') selected @endif >Debit</option>
                            <option value="credit" @if($final_account->transaction_type=='credit') selected @endif>Credit</option>
                        </select>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label" for="opening-date">Opening Date<span class="text-danger">*</span></label>
            <div class="col-lg-9">
                <input class="form-control" id="opening-date" value="{{\Carbon\Carbon::createFromFormat('Y-m-d', $final_account->date)->format('d / m / y')}}" name="opening_date" placeholder="dd/mm/yy" onkeyup="date_reformat_dd(this);" onkeypress="date_reformat_dd(this);" onpaste="date_reformat_dd(this);"  autocomplete="off" type="text">
            </div>
        </div>



    </form>
   </div>
   </div>
<div class="modal-footer">
   <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
   <button type="button" class="btn btn-success text-white" onclick="commonFunction(false,'{{ route('final_account.update',$final_account->id) }}','{{route('final_account.index')}}','post','','update-form');">Update</button>
</div>


<script>
    $('.updateSearchableSelectTransaction').select2({dropdownParent: $('.updateSearchableSelectTransaction').parent()});
</script>


