@extends('admin.layouts.app')

@section('title','Studentx')

@section('content')
  <home-component v-if="user!=null"></home-component>
@endsection

