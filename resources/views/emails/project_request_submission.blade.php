<!DOCTYPE html>
<html>
<head>
    <title>New Project Request Submission</title>
</head>
<body>
    <h1>New Project Request Submission</h1>
    <p>A new project request has been submitted with the following details:</p>
    <ul>
        <li><strong>Full Name:</strong> {{ $projectRequest->full_name }}</li>
        <li><strong>Phone Number:</strong> {{ $projectRequest->phone_number }}</li>
        <li><strong>Email:</strong> {{ $projectRequest->email }}</li>
        <li><strong>Project Status:</strong> {{ $projectRequest->project_status }}</li>
        <li><strong>Land Area:</strong> {{ $projectRequest->land_area }} m²</li>
        <li><strong>City:</strong> {{ $projectRequest->city }}</li>
        <li><strong>District:</strong> {{ $projectRequest->district }}</li>
        <li><strong>Project Category:</strong> {{ $projectRequest->project_category }}</li>
        <li><strong>Number of Flats:</strong> {{ $projectRequest->number_of_flats }}</li>
        <li><strong>Cellar Count:</strong> {{ $projectRequest->cellar_count }}</li>
        <li><strong>Floor Count:</strong> {{ $projectRequest->floor_count ?? 'N/A' }}</li>
        <li><strong>Features:</strong>
            <ul>
                <li>Ground Floor: {{ $projectRequest->ground_floor ? 'Yes' : 'No' }}</li>
                <li>First Round: {{ $projectRequest->first_round ? 'Yes' : 'No' }}</li>
                <li>Upper Annex: {{ $projectRequest->upper_annex ? 'Yes' : 'No' }}</li>
                <li>Driver's Room: {{ $projectRequest->drivers_room ? 'Yes' : 'No' }}</li>
                <li>Swimming Pool: {{ $projectRequest->swimming_pool ? 'Yes' : 'No' }}</li>
                <li>Men's Diwaniya: {{ $projectRequest->mens_diwaniya ? 'Yes' : 'No' }}</li>
                <li>Women's Diwaniya: {{ $projectRequest->womens_diwaniya ? 'Yes' : 'No' }}</li>
                <li>Parking: {{ $projectRequest->parking ? 'Yes' : 'No' }}</li>
                <li>Multiple Floors: {{ $projectRequest->multiple_floors ? 'Yes' : 'No' }}</li>
            </ul>
        </li>
        <li><strong>Submitted At:</strong> {{ $projectRequest->created_at->format('Y-m-d H:i:s') }}</li>
    </ul>
    <p>Please review the details and take appropriate action.</p>
    <p><a href="{{ route('admin.project-requests') }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">View Project Requests</a></p>
    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>