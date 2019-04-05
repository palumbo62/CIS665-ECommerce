/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IocBuildProcessorProd.java
 *   
 *   Class which inherits from the base interface.  When instantiated
 *   this class serves as the build processor for the "Prod" 
 *   (production) system.  The application "profile" setting is used
 *   to specify which build processor is to be instantiated and this 
 *   object is "injected" into the parent application object reference 
 *   at application startup.
 *   
 *******************************************************************/

package com.cis665.demo.BuildProcessor;

import java.time.LocalDateTime;

import org.slf4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Profile;
import org.springframework.stereotype.Component;

@Profile("prod")
@Component
public class IocBuildProcessProd implements IIocBuildProcessor {
	@Autowired
	protected Logger log;
	
	@Override
	public String submit() {
		String hbMsg = "PRODUCTION-SERVER ==> build-processor response: Tmstmp='" +  LocalDateTime.now() + "'";
		log.info(hbMsg);
		
		return hbMsg;		
	}
}
