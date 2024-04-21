$(document).ready(function() {
  const daysContainer = $(".days");
  const nextBtn = $(".next-btn");
  const prevBtn = $(".prev-btn");
  const month = $(".month");
  const todayBtn = $(".today-btn");

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  let currentMonth = new Date().getMonth();
  let currentYear = new Date().getFullYear();

  renderCalendar();

  function renderCalendar() {
    const date = new Date(currentYear, currentMonth, 1);
    const firstDay = date.getDay();
    const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();

    month.html(`${months[currentMonth]} ${currentYear}`);

    let daysHTML = "";

    for (let i = 0; i < firstDay; i++) {
      daysHTML += `<div class="day prev"></div>`;
    }

    for (let i = 1; i <= lastDay; i++) {
      daysHTML += `<div class="day">${i}</div>`;
    }

    daysContainer.html(daysHTML);

    hideTodayBtn();
  }

  function hideTodayBtn() {
    todayBtn.css(
      "display",
      currentMonth === new Date().getMonth() &&
        currentYear === new Date().getFullYear()
        ? "none"
        : "flex"
    );
  }

  nextBtn.on("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    renderCalendar();
  });

  prevBtn.on("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    renderCalendar();
  });

  todayBtn.on("click", () => {
    currentMonth = new Date().getMonth();
    currentYear = new Date().getFullYear();
    renderCalendar();
  });

  $.ajax({
    url: "../api/fetch_booked_dates.php",
    method: "GET",
    dataType: "json",
    success: function(data) {
      const { fully_booked_dates } = data;

      fully_booked_dates.forEach((date) => {
        const dayElement = $(".day").filter(function() {
          return $(this).text() == date.split('-')[2]; // Split date to get day
        });
        dayElement.addClass("today");
      });

      console.log("Fully booked dates:", fully_booked_dates);
    },
    error: function(xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
});
