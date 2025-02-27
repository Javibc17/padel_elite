<?php
 
namespace App\Controllers;
 
use App\Models\EventModel;
 
class EventController extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index(): string
    {
        return view('pages/lists/calendar');
    }

    public function fetchEvents()
    {
        $event = $this->eventModel->findAll();
        return $this->response->setJSON($event);
    }

    public function addEvent()
    {
        $data = $this->request->getPost();

        // Log the received data for debugging
        log_message('debug', 'Received data for addEvent: ' . json_encode($data));

        // Check if data is not empty
        if (empty($data)) {
            // Handle the error, e.g., set a flash message or return an error response
            return redirect()->back()->with('error', 'No data provided for the event.');
        }

        // Validate the data (example: check if 'TITLE' and 'START_DATE' fields are present)
        if (empty($data['TITLE']) || empty($data['START_DATE'])) {
            return redirect()->back()->with('error', 'Title and start date are required.');
        }

        // Proceed with the insert if data is not empty
        if ($this->eventModel->insert($data)) {
            return redirect()->to('/calendar')->with('success', 'Event added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add event.');
        }
    }

    public function deleteEvent($id)
    {
        if ($this->eventModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Event not found']);
        }
    }
}