@extends('errors::minimal')

@section('title', $exception->getMessage())
@section('code', '404')
@section('message', $exception->getMessage())
