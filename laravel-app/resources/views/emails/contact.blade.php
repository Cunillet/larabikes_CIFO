<h1>Larabikes Message</h1>

<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Subject:</strong> {{ $data['subject'] }}</p>
<hr>
<p>{{ nl2br(e($data['message'])) }}</p>
