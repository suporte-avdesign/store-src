<a href="javascript:baselThemeModule.backHistory()" class="basel-back-btn basel-tooltip">
    <span>{{constLang('back')}}</span>
</a>
<!--breadcrumb -->
<nav class="woocVoommerce-breadcrumb">
    <a href="{{route('home')}}">Home </a>|
    <a href="{{url(setRoute('section').$section->slug)}}">{{$section->name}} </a>|
    <a href="{{url(setRoute('category').$category->slug)}}">{{$category->name}} </a>|
    <span class="breadcrumb-last"> {{$product->name}}</span>
</nav>
