<?php include "template/header.php" ?>
<article>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <address>
                    <strong>Endereço</strong><br />
                    Maringá-PR<br/>
                    Brasil<br/><br/>
                    <strong>Telefone</strong><br />
                    <a href="callto:+554499374917">(44)9937-4917</a><br/><br/>
                    <strong>Email</strong><br />
                    <a href="mailto:henriquerozada@hotmail.com">henriquerozada@hotmail.com</a>
                </address> 
            </div>
        </div>
        <!--<div class="row">
            <div class="col-sm-12">
                <form role="form">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome para contato" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : "" ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email.para.contato@example.com" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "" ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="subject">Assunto:</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto da mensagem"/>
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea class="form-control" rows="5" id="mensagem" name="mensagem" placeholder="Corpo da mensagem"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Enviar</button>
                </form>
            </div>
        </div>-->
    </div>
</article>
<?php require "template/footer.php" ?>