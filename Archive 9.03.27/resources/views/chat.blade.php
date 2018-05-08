@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
@section('content')

<div class="container">
    <h1 class="text-center">Chat Application</h1>
    <message :messages="messages"></message>
    <sent-message v-on:messagesent="addMessage" :user="{{Auth::user()}}"></sent-message>
</div>
@endsection