<div class="newTicket_body">
    <form method="POST" action="./?action=new" name="newTicketForm">
        <div>
            <div class="newTicket_header">
                New Ticket
            </div>
        </div>
        <div class="newTicket newTicket_subject">
            <label for="subject">Subject</label>
            <textarea name="subject" maxlength="128"></textarea>
        </div>
        <div class="newTicket newTicket_message">
            <label for="text">Message</label>
            <textarea name="text" maxlength="1024"></textarea>
        </div>
        <div class="submitButton">
            <input type="submit">
        </div>
    </form>
</div>