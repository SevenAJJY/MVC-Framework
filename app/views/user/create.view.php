<div class="home-content">
    <div class="row">
        <h1 class="main-title text-center">Add New User</h1>
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="my-container fuser">
                <h4>New User</h4>
                <form action="" class="appform row" method="POST" enctype="multipart/form-data"
                    enctype="application/x-www-form-urlencoded">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" class="FirstName" name="name" id="FirstName"
                                maxlength="10" required>
                            <label for="name">name</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="text" spellcheck="false" name="address" id="LastName" maxlength="10" required>
                            <label for="address">address</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" class="Username" name="age" id="Username"
                                maxlength="30" required>
                            <label for="age" class="labelerror">age</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" step="0.01" id="Number" name="salary" required>
                            <label for="Number">Salary</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="number" spellcheck="false" step="0.01" id="Number" name="tax" required>
                            <label for="Number">Tax</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="input-box">
                            <input type="file" name="image">
                            <label for="image">Image</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-box">
                            <input type="submit" name="submit" value="Save" maxlength="30" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>