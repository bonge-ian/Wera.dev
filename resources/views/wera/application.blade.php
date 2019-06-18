<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/css/uikit.min.css" />

</head>
  <body>
    
    <table class="uk-table  uk-table-divider uk-table-striped">
        
        <tbody>
            <tr>
                <td>First name: </td>
                <td>{{ $application['firstname'] }}</td>
            </tr>
            <tr>
                <td>Last name: </td>
                <td>{{ $application['lastname'] }}</td>
            </tr>
            <tr>
                <td>Email: </td>
                <td>{{ $application['email'] }}</td>
            </tr>
            <tr>
                <td>Experience Level:</td>
                <td>{{ $application['experience'] }}</td>
            </tr>
            <tr>
                <td>Availability: </td>
                <td>{{ $application['availability'] }}</td>
            </tr>
            <tr>
                <td>coverletter: </td>
                <td>{!! $application['message'] !!}</td>
            </tr>
            <tr>
                <a href="{{ route('jobs.download', ['job'=> $application['job_id'], 'name' => $application['firstname']])  }}" download="/{{ $application['resume']  }}">Download Reseume</a>
            </tr>
        </tbody>
    </table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/js/uikit-icons.min.js"></script>
  </body>
</html>