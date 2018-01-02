@extends('layouts.guest')

@section('content')
<section class="flex-center register-page">

		@if ($errors->any())
			<v-alert type="error" value="true" icon="error" dismissable="true">
				<ul>
					@foreach ($errors->all() as $error)
						<li style="border: none;">{{ $error }}</li>
					@endforeach
				</ul>
			</v-alert>
		@endif

	<register-form>
	</register-form>
</section>
@endsection
