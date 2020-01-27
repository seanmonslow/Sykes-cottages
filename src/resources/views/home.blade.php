<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
		<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Karla">
        <style>
	      body {
	        font-family: Karla, Arial, serif;
	      }
	      input {
	      	color:black;
	      }
	    </style>
	</head>
	<body class="bg-gray-100">
		<nav class="flex items-center justify-between flex-wrap p-6" style="background-color:#22313f">
		</nav>
		<div class="flex p-4 items-start">
			<form class="w-1/3 bg-white border-solid border-2 border-gray-400 flex flex-col p-2 h-auto" action="/search" method="GET">
				{{ csrf_field() }}
				<span class="border-b border-black">
					Find your cottage
				</span>
				<div class="flex flex-col pt-1">
					<input type="text" name="name" class="border border-solid border-black" placeholder="Name of property" value="{{request()->query('name')}}">
					<span>
						Name matching
					</span>
					<select name="type">
						<option value="1" @if (request()->query('type') == 1) selected @endif>Exact</option>
						<option value="2" @if (request()->query('type') == 2) selected @endif>Partial</option>
					</select>
				</div>
				<div class="flex flex-col pt-1">
					<span>
						Near the beach
					</span>
					<select name="beach">
						<option value="0">Please select</option>
						<option value="2" @if (request()->query('beach') == 2) selected @endif>Yes</option>
						<option value="1" @if (request()->query('beach') == 1) selected @endif>No</option>
					</select>
				</div>
				<div class="flex flex-col pt-1">
					<span>
						Allows pets
					</span>
					<select name="pets">
						<option value="0">Please select</option>
						<option value="2" @if (request()->query('pets') == 2) selected @endif>Allows pets</option>
						<option value="1" @if (request()->query('pets') == 1) selected @endif>Doesn't allow pets</option>
					</select>
				</div>
				<div class="flex flex-col pt-1">
					<span>
						How many does it sleep?
					</span>
					<input type="number" name="sleeps" class="border border-solid border-black" value="{{request()->query('sleeps')}}">
				</div>
				<div class="flex flex-col pt-1">
					<span>
						How many beds?
					</span>
					<input type="number" name="beds" class="border border-solid border-black" value="{{request()->query('beds')}}">
				</div>
				<div class="flex flex-col pt-1">
					<span>
						Date
					</span>
					<input type="date" name="date" class="border border-solid border-black" value="{{request()->query('date')}}">
				</div>
                @if($errors->any())
				    {!! implode('', $errors->all('<div>:message</div>')) !!}
				@endif
				<input type="submit" value="Search" class="width-100 mt-1" style="background-color:#3c6f97; color:white;">
			</form>
			<div class="w-2/3 flex flex-col px-2">
				{{ $properties->links() }}
				@foreach ($properties as $property)
					<div class="flex flex-col my-2 bg-white shadow-2xl rounded p-2">
						<span>Location Name: {{$property->property_name}}</span>
						<span>Is it near the beach?@if($property->near_beach == 1) Yes @else No @endif</span>
						<span>Does it accept pets?@if($property->accepts_pets == 1) Yes @else No @endif</span>
						<span>How many does it sleep? {{$property->sleeps}}</span>
						<span>How many beds does it have? {{$property->beds}}</span>
						@if($property->price)
						<span>Price: £{{$property->price}} @if($property->discount)(-{{$property->discount}}%)@endif</span>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</body>
</html>
