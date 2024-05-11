@extends('admin.layouts.master')

@section('head-tag')
    <title>کالا ها</title>
    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالا ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کالا</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کالا
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.product.update',[$product->id])}}" method="post" id="form"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">نام کالا</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                           value="{{old('name',$product->name)}}">
                                </div>
                                @error('name')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                           value="{{old('tags',$product->tags)}}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="" class="border-bottom">دسته کالا</label>
                                    <section class="table-responsive" style="max-height: 130px">
                                        @forelse($categories as $category)
                                            <section>
                                                <input type="checkbox"
                                                       @if(in_array($product->id,$category->products()->get()->pluck('id')->toArray())) checked
                                                       @endif name="categories[]" value="{{$category->id}}"
                                                       id="{{$category->id}}">
                                                <label for="{{$category->id}}">
                                                    <span>{{$category->name}}</span>
                                                </label>
                                            </section>
                                        @empty
                                            <section>
                                                <label>
                                                    <span>فاقد دسته بندی</span>
                                                </label>
                                            </section>
                                        @endforelse
                                    </section>
                                </div>
                                @error('categories.*')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">برند کالا</label>
                                    <select name="brand_id" id="" class="form-control form-control-sm">
                                        <option value="">برند را انتخاب کنید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}"
                                                    @if(old('brand_id',$product->brand_id)==$brand->id) selected @endif>{{$brand->original_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('brand_id')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0" @if(old('status',$product->status)==0) selected @endif>غیر
                                            فعال
                                        </option>
                                        <option value="1" @if(old('status',$product->status)==1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">قابل فروش بودن</label>
                                    <select name="marketable" id="" class="form-control form-control-sm">
                                        <option value="0"
                                                @if(old('marketable',$product->marketable)==0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1"
                                                @if(old('marketable',$product->marketable)==1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('marketable')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تاریخ انتشار</label>
                                    <input type="text" class="form-control form-control-sm d-none" name="published_at"
                                           id="published_at" value="{{$product->published_at}}">
                                    <input type="text" class="form-control form-control-sm" id="published_at_view"
                                           name="published_at_view" value="{{$product->published_at}}">
                                </div>
                                @error('published_at')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">سایز (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="size"
                                           value="{{old('size',$product->size)}}">
                                </div>
                                @error('size')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">جنس (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="material"
                                           value="{{old('material',$product->material)}}">
                                </div>
                                @error('material')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویژگی 1 (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_1"
                                           value="{{old('feature_1',$product->feature_1)}}">
                                </div>
                                @error('feature_1')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویژگی 2 (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_2"
                                           value="{{old('feature_2',$product->feature_2)}}">
                                </div>
                                @error('feature_2')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویژگی 3 (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_3"
                                           value="{{old('feature_3',$product->feature_3)}}">
                                </div>
                                @error('feature_3')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویژگی 4 (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_4"
                                           value="{{old('feature_4',$product->feature_4)}}">
                                </div>
                                @error('feature_4')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ویژگی 5 (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="feature_5"
                                           value="{{old('feature_5',$product->feature_5)}}">
                                </div>
                                @error('feature_5')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">وزن (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="weight"
                                           value="{{old('weight',$product->weight)}}">
                                </div>
                                @error('weight')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">طول (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="length"
                                           value="{{old('length',$product->length)}}">
                                </div>
                                @error('length')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">عرض (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="width"
                                           value="{{old('width',$product->width)}}">
                                </div>
                                @error('width')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">ارتفاع (اختیاری)</label>
                                    <input type="text" class="form-control form-control-sm" name="height"
                                           value="{{old('height',$product->height)}}">
                                </div>
                                @error('height')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">قیمت کالا</label>
                                    <input type="text" class="form-control form-control-sm" name="price"
                                           value="{{old('price',$product->price)}}">
                                </div>
                                @error('price')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">تصویر</label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                </div>
                                @error('image')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-1">
                                <section class="row">
                                    @php
                                        $number=1;
                                    @endphp
                                    @foreach($product->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{6/$number}}">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="currentImage"
                                                       value="{{$key}}" id="{{$number}}"
                                                       @if($product->image['currentImage']==$key) checked @endif>
                                                <label class="form-check-label mx-2" for="{{$number}}">
                                                    <img src="{{asset($value)}}" class="w-100">
                                                </label>
                                            </div>
                                        </section>
                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach
                                </section>
                            </section>
                            <section class="col-12  my-1">
                                <div class="form-group">
                                    <label for="">معرفی محصول</label>
                                    <textarea name="introduction" id="introduction" class="form-control form-control-sm"
                                              rows="6">{{old('introduction',$product->introduction)}}</textarea>
                                </div>
                                @error('introduction')
                                <span class="text-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 border-top border-bottom py-3 mb-3">
                                @foreach($product->metas as $meta)
                                    <section class="row">
                                        <section class="col-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="meta_key[]"
                                                       class="form-control form-control-sm"
                                                       value="{{$meta->meta_key}}">
                                            </div>
                                        </section>

                                        <section class="col-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="meta_value[]"
                                                       class="form-control form-control-sm"
                                                       value="{{$meta->meta_value}}">
                                            </div>
                                        </section>

                                    </section>
                                @endforeach


                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('scripts')

    @include('admin.layouts.ckeditor')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }
            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد کنید',
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function (event) {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }
            })

        })
    </script>

@endsection
