function saveEvent(event) {
    fetch('http://localhost/event_calendar/save_event.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(event)
    })
    .then(response => response.json())
    .then(data => {
      console.log('Event saved:', data);
    })
    .catch(error => {
      console.error('Error saving event:', error);
    });
  }
  
  addEventBtn.addEventListener("click", () => {
    const eventTitle = eventTitleInput.value;
    const eventTimeFromValue = eventTimeFrom.value;
    const eventTimeToValue = eventTimeTo.value;
  
    if (eventTitle === "" || eventTimeFromValue === "" || eventTimeToValue === "") {
      alert("Please fill all the fields");
      return;
    }
  
    const timeFromArr = convertTime(eventTimeFromValue);
    const timeToArr = convertTime(eventTimeToValue);
  
    if (timeFromArr[0] > timeToArr[0] || (timeFromArr[0] === timeToArr[0] && timeFromArr[1] >= timeToArr[1])) {
      alert("Invalid Time Range");
      return;
    }
  
    const time = `${eventTimeFromValue} - ${eventTimeToValue}`;
    const newEvent = {
      title: eventTitle,
      time_from: eventTimeFromValue,
      time_to: eventTimeToValue,
      day: activeDay,
      month: month + 1,
      year
    };
  
    let eventAdded = false;
    if (eventsArr.length > 0) {
      eventsArr.forEach((item) => {
        if (item.day === activeDay && item.month === month + 1 && item.year === year) {
          item.events.push(newEvent);
          eventAdded = true;
        }
      });
    }
  
    if (!eventAdded) {
      eventsArr.push({
        day: activeDay,
        month: month + 1,
        year,
        events: [newEvent],
      });
    }
  
    addEventWrapper.classList.remove("active");
    eventTitleInput.value = "";
    eventTimeFrom.value = "";
    eventTimeTo.value = "";
    updateEvents(activeDay);
    saveEvent(newEvent); // Save event to the server
  });
  
  function convertTime(time) {
    const timeArr = time.split(":");
    const timeHour = timeArr[0];
    const timeMinute = timeArr[1];
    return [parseInt(timeHour), parseInt(timeMinute)];
  }
  