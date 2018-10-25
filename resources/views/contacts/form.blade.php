<div class="form-group">
    <label for="name">Name:</label>
    {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="company">Company:</label>
    {!! Form::text('company',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="email">Email:</label>
    {!! Form::email('email',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="phone">Phone:</label>
    {!! Form::text('phone',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="address">Address:</label>
    {!! Form::textarea('address',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="group">Group:</label>
    {!! Form::select('group_id', App\Group::pluck('name','id'),null,['class'=>'form-control']) !!}
    <br>
    <a style="color: #ffffff;" id="add-group-btn" class="btn btn-success">Add group</a>
</div>
<div class="form-group" id="add-new-group">
    <div class="input-group">
        <label for="group">Group:</label>
        {!! Form::text('new_group',null,['class'=>'form-control','id'=>'new-group']) !!}
        <a href="javascript:void(0)" id="add-new-btn" class="btn btn-default">Add</a>
    </div>
</div>
<button type="submit" class="btn btn-default">{{ !empty($contact->id) ? 'Update' : 'Save' }}</button>

@section('scripts')
    <script>
        $("#add-new-group").hide();
        $("#add-group-btn").click(function () {
            $("#add-new-group").slideToggle(function () {
                $("#new-group").focus();
            });
            return false;
        });

        $("#add-new-btn").click(function () {
            var newGroup = $("#new-group");
            var inputGroup = newGroup.closest('.input-group');
            $.ajax({
                url: "{{ route('groups.store') }}",
                method: 'post',
                data: {
                    name: $("#new-group").val(),
                    _token: $("input[name=_token]").val()
                },
                success: function (group) {
                    if (group.id != null) {
                        inputGroup.removeClass('has-error');
                        inputGroup.next('.text-danger').remove();
                        var newOption = $('<option></option>')
                            .attr('value', group.id)
                            .attr('selected', true)
                            .text(group.name);

                        $("select[name=group_id]")
                            .append(newOption);
                        newGroup.val("");
                    }
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON;
                    var error = errors.name[0];
                    if (error) {
                        inputGroup.next('.text-danger').remove();
                        inputGroup.addClass('has-error').after('<p class="text-danger">' + error + '</p>');
                    }
                }
            })
        })
    </script>
@endsection