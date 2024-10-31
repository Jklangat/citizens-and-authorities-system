function getEvents() {
    fetch('http://localhost/event_calendar/get_events.php')
      .then(response => response.json())
      .then(data => {
        eventsArr = data;
        initCalendar();
      })
      .catch(error => {
        console.error('Error fetching events:', error);
      });
  }
  
  // Call getEvents() when initializing the calendar
  getEvents();
  
  function updateEvents(date) {
    let events = "";
    eventsArr.forEach((event) => {
      if (date === event.day && month + 1 === event.month && year === event.year) {
        event.events.forEach((event) => {
          events += `<div class="event">
              <div class="title">
                <i class="fas fa-circle"></i>
                <h3 class="event-title">${event.title}</h3>
              </div>
              <div class="event-time">
                <span class="event-time">${event.time_from} - ${event.time_to}</span>
              </div>
          </div>`;
        });
      }
    });
    if (events === "") {
      events = `<div class="no-event">
              <h3>No Events</h3>
          </div>`;
    }
    eventsContainer.innerHTML = events;
  }
  