<div>
    <h1>Leads {{$leadsCount}}</h1>
    @forelse($leads as $lead)
        <div>
            <p>Lead from: {{$lead->name}}, phone: {{$lead->phone}}, email: {{$lead->email}}</p>
            <br>
            <p>nominated person: {{$lead->nominated_person}}, status: {{$lead->status}}, date of creation^ {{$lead->date_of_creation}}</p>
            <br>
            <p>description: {{$lead->description}}</p>
            <br>
            <br>
        </div>
    @empty
        <p>Ничего не найдено</p>
    @endforelse
</div>
