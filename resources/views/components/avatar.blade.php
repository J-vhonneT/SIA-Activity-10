@props(['name'])

@php
$initial = strtoupper(substr($name, 0, 1));
@endphp


<div style="
width:40px;
height:40px;
border-radius:50%;
background:#4f46e5;
color:white;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
font-size:18px;">
    {{ $initial }}
</div>