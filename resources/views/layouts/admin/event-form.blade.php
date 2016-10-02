@extends('layouts.app')
@section('contentheader_title', 'События')
@section('htmlheader_title', $post->exists ? 'Редактирование: ' . $post->title : 'Добавить новое событие')

@section('main-content')
    <div class="spark-screen">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $post->exists ? 'Редоктировать: ' . $post->title : 'Добавить новое событие' }}</h2>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($post, [
                'route' => $post->exists ? ['posts.update', $post->id] : ['posts.store'],
                'method' => $post->exists ? 'PUT' : 'POST',
                'files' => true
            ]) !!}

            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('title', 'Заголовок') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            {!! Form::label('price', 'Цена') !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                {!! Form::text('price', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            {!! Form::label('currency', 'Валюта') !!}
                            <div class="input-group">
                                {!! Form::select('currency', ['UAH' => 'ГРН', 'USD' => 'USD', 'EUR' => 'EUR'], 'UAH', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1" style="padding-top:30px;">
                            <div class="input-group">
                                <div class="checkbox">
                                    {!! Form::checkbox('e_free', 1, $post->exists ? (bool) $post->e_free : false) !!}
                                </div>
                                {!! Form::label('e_free', 'Бесплатно') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            {!! Form::label('start_date', 'Начало события') !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('start_date', $post->exists ? $post->start_date : null, ['class' => 'form-control', 'id' => 'start_date']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            {!! Form::label('end_date', 'Конец события') !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('end_date', $post->exists ? $post->end_date : null, ['class' => 'form-control', 'id' => 'end_date']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="colg-lg-2 col-md-2">
                            <div class="input-group clockpicker">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </div>
                                {!! Form::text('start_time', $post->exists ? $post->start_time : '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="input-group clockpicker end-timepicker">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </div>
                                <div style="width: 100%;">
                                    {!! Form::text('end_time', $post->exists ? $post->end_time : '', ['class' => 'form-control hidden']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Описание') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::label('category[]', 'Категория') !!}
                            <div class="input-group">
                                {!! Form::select('category[]', $categories[App\Type::TYPE_CATEGORY], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('category[]', 'Для кого?') !!}
                            <div class="input-group">
                                {!! Form::select('category[]', $categories[App\Type::TYPE_FOR], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('category[]', 'Где?') !!}
                            <div class="input-group">
                                {!! Form::select('category[]', $categories[App\Type::TYPE_WHERE], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('category[]', 'Что делать?') !!}
                            <div class="input-group">
                                {!! Form::select('category[]', $categories[App\Type::TYPE_TODO], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::label('city', 'Город') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                {!! Form::text('city', $post->exists ? $post->city : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('address', 'Адрес') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                {!! Form::text('address', $post->exists ? $post->address : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding-top:30px;">
                            <div class="input-group">
                                <div class="checkbox">
                                    {!! Form::checkbox('e_online', 1, $post->exists ? (bool) $post->e_online : false) !!}
                                </div>
                                {!! Form::label('e_online', 'Онлайн') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::label('phone', 'Телефон') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                {!! Form::text('phone', $post->exists ? $post->phone : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('email', 'Email') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                {!! Form::text('email', $post->exists ? $post->email : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::label('source_url', 'Website (источник)') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                {!! Form::text('source_url', $post->exists ? $post->source_url : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @if( $post->exists )
                        <img src="{{ url($post->image) }}" align="right" width="100">
                    @endif
                    {!! Form::label('image', 'Загрузить картинку') !!}
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    <p class="help-block">Основная фотография события. Поддерживаемые форматы: JPG, PNG.</p>
                </div>
            </div>
            <div class="box-footer">
                {!! Form::submit($post->exists ? 'Сохранить' : 'Добавить', ['class' => 'btn btn-primary']) !!}
                @if( $post->exists )
                    {!! Form::submit('Отмена', [
                    'onclick' => 'window.location="' . route('posts.index'). '";return false;',
                    'class' => 'btn btn-warning'
                    ]) !!}
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('post-scripts')
    <!-- bootstrap datepicker -->
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap time picker -->
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Summernote editor -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <!-- FastClick -->
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/fastclick/fastclick.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('js/clockpicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            var ReadMoreButton = function (context) {
                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-scissors"/> Read more',
                    tooltip: 'insert read more tag',
                    click: function () {
                        context.invoke('editor.insertText', '\<!--more-->');
                    }
                });

                return button.render();   // return button as jquery object
            };
            $('#description').summernote({
                height: 300,
                toolbar: [
                    ['Font Style', ['fontname', 'fontsize', 'color', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['Paragraph style', ['style', 'ol', 'ul', 'paragraph', 'height']],
                    ['Insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']],
                    ['Read more', ['readmore']]
                ],
                buttons: {
                    readmore: ReadMoreButton
                }
            });
//            $('#description').summernote({
//                'insertText', 'hello world'});
            {{--            $('#description').code({{  $post->exists ? $post->description : '' }});--}}

            //Date picker
            $('#start_date').datepicker({
                autoclose: true
            });
            $('#end_date').datepicker({
                autoclose: true
            });

            // disable currency and price fields on free events
            var checkBoxes = $('input[name=price], select[name=currency]');
            var eFree = $('input[name=e_free]');
            var eFreeState = eFree[0].getAttribute('checked');
            if (eFreeState == 'checked') {
                checkBoxes.prop('disabled', !checkBoxes.prop('disabled'));
            }
            eFree.click(function () {
                checkBoxes.prop('disabled', !checkBoxes.prop('disabled'));
                $('input[name=price]').prop('value', '');
            });

            // disable location fields on online events
            var onlineEvent = $('input[name=address], input[name=city]');
            var eOnline = $('input[name=e_online]');
            var eOnlineState = eOnline[0].getAttribute('checked');
            if (eOnlineState == 'checked') {
                onlineEvent.prop('disabled', !onlineEvent.prop('disabled'));
            }
            eOnline.click(function () {
                onlineEvent.prop('disabled', !onlineEvent.prop('disabled'));
                onlineEvent.prop('value', '');
            });


            // make end time input visible when clicked on icon with end-timepicker class
            $('.end-timepicker div').click(function () {
                var endTimeInput = $('input[name=end_time]');
                endTimeInput.removeClass('hidden');
                $('.end-timepicker').removeClass('end-timepicker');
            });

        });
    </script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            donetext: 'Done',
            autoclose: true
        });
    </script>
@endsection