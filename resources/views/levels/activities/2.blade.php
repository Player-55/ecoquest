<p class="muted">Answer five questions about your normal week. You'll get a footprint rating and personal tips. This is a learning tool, so it gives a relative score, not an exact carbon measurement.</p>
<form data-activity="calculator" novalidate>
    <fieldset class="calc-q" data-cat="transport">
        <legend>1. How do you usually get to class?</legend>
        <label><input type="radio" name="transport" value="0"> Walk or cycle</label>
        <label><input type="radio" name="transport" value="1"> Campus bus, LRT, MRT or public bus</label>
        <label><input type="radio" name="transport" value="2"> Carpool or motorcycle</label>
        <label><input type="radio" name="transport" value="3"> Drive alone or e-hailing alone</label>
    </fieldset>
    <fieldset class="calc-q" data-cat="ac">
        <legend>2. How many hours a day is your air-conditioner on?</legend>
        <label><input type="radio" name="ac" value="0"> I don't use air-con (fan only)</label>
        <label><input type="radio" name="ac" value="1"> Less than 4 hours</label>
        <label><input type="radio" name="ac" value="2"> 4 to 8 hours</label>
        <label><input type="radio" name="ac" value="3"> More than 8 hours, or it is always on</label>
    </fieldset>
    <fieldset class="calc-q" data-cat="food">
        <legend>3. How much food do you usually throw away?</legend>
        <label><input type="radio" name="food" value="0"> Almost none, I finish my food</label>
        <label><input type="radio" name="food" value="1"> A little, a few times a week</label>
        <label><input type="radio" name="food" value="2"> Some leftovers most days</label>
        <label><input type="radio" name="food" value="3"> A lot, I often order more than I can eat</label>
    </fieldset>
    <fieldset class="calc-q" data-cat="plastic">
        <legend>4. How often do you use single-use plastic (bags, straws, cups, tapau boxes)?</legend>
        <label><input type="radio" name="plastic" value="0"> Rarely, I bring my own</label>
        <label><input type="radio" name="plastic" value="1"> A few times a week</label>
        <label><input type="radio" name="plastic" value="2"> Once a day</label>
        <label><input type="radio" name="plastic" value="3"> Several times a day</label>
    </fieldset>
    <fieldset class="calc-q" data-cat="shopping">
        <legend>5. How often do you buy new clothes or gadgets online?</legend>
        <label><input type="radio" name="shopping" value="0"> Rarely, only when I really need something</label>
        <label><input type="radio" name="shopping" value="1"> Once every few months</label>
        <label><input type="radio" name="shopping" value="2"> Once a month</label>
        <label><input type="radio" name="shopping" value="3"> Every week, especially during sales</label>
    </fieldset>
    <p class="calc-error small" style="color:var(--danger)" aria-live="polite"></p>
    <button type="submit" class="btn btn-primary">Calculate my footprint</button>

    <div class="calc-result card" aria-live="polite">
        <h3 class="calc-title">Your footprint</h3>
        <div class="meter" aria-hidden="true"><span class="needle"></span></div>
        <div class="meter-labels"><span>Low</span><span>Medium</span><span>High</span></div>
        <p class="calc-text" style="margin-top:12px"></p>
        <h4>Your top tips</h4>
        <ul class="calc-tips"></ul>
    </div>
</form>
